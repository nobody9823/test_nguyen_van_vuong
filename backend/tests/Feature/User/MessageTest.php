<?php

namespace Tests\Feature\User;

use App\Models\Admin;
use App\Models\Company;
use App\Models\MessageContent;
use App\Models\Option;
use App\Models\Plan;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectVideo;
use App\Models\Talent;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserPlanCheering;
use App\Models\UserProjectLiked;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        $response = $this->actingAs($this->user, 'web')->get(route('user.message.index'));
        $response->assertOk();
        $response->assertSee('メッセージ一覧');
    }

    /**
     * A basic feature test show.
     *
     * @return void
     */
    public function test_show()
    {
        $response = $this->actingAs($this->user, 'web')->get(route("user.message.show", ['message' => UserPlanCheering::first()]));
        $response->assertOk();
        $response->assertSee('メッセージ一覧');
        $response->assertSeeTextInOrder([$this->userPlanCheering->plan->project->talent->name,$this->userPlanCheering->plan->title]);
    }

    /**
     * A basic feature test show.
     *
     * @return void
     */
    public function test_store_and_file_download()
    {
        // Storage::fake('tests');
        $file = UploadedFile::fake()->image('test.jpg');
        $response = $this->actingAs($this->user, 'web')->post(route("user.message_content.store", ['user_plan_cheering' => UserPlanCheering::first()]), [
            'content' => 'これはテストです',
            'file_path' => $file,
        ]);
        $response->assertSessionHas('flash_message', 'メッセージ送信が完了しました。');
        $this->assertDatabaseHas('message_contents', [
            'content' => 'これはテストです',
            'message_contributor'=> '支援者',
            'file_path'=> 'public/file/'.$file->hashName(),
        ]);

        // 確認
        $response = $this->actingAs($this->user, 'web')->get(route("user.message.show", ['message' => UserPlanCheering::first()]));
        $response->assertOk();
        $response->assertSee('メッセージ一覧');
        $response->assertSeeText('これはテストです');

        $response = $this->actingAs($this->user, 'web')->get(route('user.message_content.file_download', [
            'message_content' => MessageContent::first(),
        ]));
        $response->assertOk();
        $response->assertHeader('Content-Type', 'image/jpeg');
        $response->assertHeader('Content-Disposition', 'attachment; filename=test.jpg');
    }
}
