<?php

namespace Tests\Feature\Company;

use App\Mail\Admin\NotificationMessage;
use App\Models\Admin;
use App\Models\Company;
use App\Models\MessageContent;
use App\Models\Plan;
use App\Models\Project;
use App\Models\Talent;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserPlanCheering;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();
        // リレーションで色々詰まったのですべて書いちゃった
        $this->user = User::factory()->valleyin()->create();
        $this->company = Company::factory()->valleyin()->create();
        $this->userAddress = $this->user->userAddresses()->save(UserAddress::factory()->make());
        $this->talent = $this->company->talents()->save(Talent::factory()->make());
        $this->project = $this->talent->projects()->save(Project::factory()->make());
        $this->plan = $this->project->plans()->save(Plan::factory()->make());
        $this->userPlanCheering = UserPlanCheering::factory()->state([
            'user_id' => $this->user->id,
            'plan_id' => $this->plan->id,
            'address_id' => $this->userAddress->id,
        ])->create();
    }

    /**
     * A basic feature test index.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->actingAs($this->company, 'company')->get(route('company.message.index'));
        $response->assertOk();
        $response->assertSee('メッセージ一覧');
    }

    /**
     * A basic feature test show.
     *
     * @return void
     * @test
     */
    public function test_show()
    {
        $response = $this->actingAs($this->company, 'company')->get(route("company.message.show", ['message' => UserPlanCheering::first()]));
        $response->assertOk();
        $response->assertSee('メッセージ一覧');
        $response->assertSeeTextInOrder([$this->userPlanCheering->user->name,$this->userPlanCheering->plan->title]);
    }

    /**
     * A basic feature test show.
     *
     * @return void
     */
    public function test_store_and_fileDownload_and_sendEmail()
    {
        // アップロードされた写真を想定
        $file = UploadedFile::fake()->image('test.jpg');
        // 実際にはメールを送らないように設定
        Mail::fake();
        // メールが送られていないことを確認
        Mail::assertNothingSent();

        $file = UploadedFile::fake()->image('test.jpg');
        $response = $this->actingAs($this->company, 'company')->post(route("company.message_content.store", ['user_plan_cheering' => UserPlanCheering::first()]), [
            'content' => 'これはテストです',
            'file_path' => $file,
        ]);
        $response->assertSessionHas('flash_message', 'メッセージ送信が完了しました。');
        $this->assertDatabaseHas('message_contents', [
            'content' => 'これはテストです',
            'message_contributor'=> 'タレント',
            'file_path'=> 'public/file/'.$file->hashName(),
        ]);

        // 確認
        $response = $this->actingAs($this->company, 'company')->get(route("company.message.show", ['message' => UserPlanCheering::first()]));
        $response->assertOk();
        $response->assertSee('メッセージ一覧');
        $response->assertSeeText('これはテストです');

        $response = $this->actingAs($this->company, 'company')->get(route('company.message_content.file_download', [
            'message_content' => MessageContent::first(),
        ]));
        $response->assertOk();
        $response->assertHeader('Content-Type', 'image/jpeg');
        $response->assertHeader('Content-Disposition', 'attachment; filename=test.jpg');

        // メッセージが指定したユーザーに届いたことをアサート
        Mail::assertSent(NotificationMessage::class, function ($mail) {
            return $mail->hasTo($this->user->email);
        });
        // メールが1回送信されたことをアサート
        Mail::assertSent(NotificationMessage::class, 1);
    }
}
