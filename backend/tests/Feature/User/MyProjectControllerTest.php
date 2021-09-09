<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Identification;
use App\Models\Address;
use Carbon\Carbon;
use App\Models\ProjectFile;
use App\Models\Plan;
use Tests\TestCase;

class MyProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->users = User::factory()
            ->has(Identification::factory()->state(['connected_account_id' => 'acct_1JVd3nRneYkDOHDQ']))
            ->has(Address::factory())
            ->has(Profile::factory())
            ->has(
                Project::factory()->released()
                    ->has(
                        ProjectFile::factory()->state([
                            'file_url' => 'public/sampleImage/now_printing.png',
                            'file_content_type' => 'image_url',
                        ])
                    )
                    ->has(
                        Plan::factory()->state([
                            'price' => 1000
                        ])
                    )
            )->count(10)->create();

        $this->user = $this->users->first();

        $this->project = $this->user->projects()->first();

        $this->my_project = Project::factory()->state([
            'user_id' => $this->user->id,
            'release_status' => '---',
        ])->create();

        $this->plan = $this->project->plans()->first();

        $date = Carbon::now();

        $this->target_amount_params = [
            'target_amount' => 10000,
            'start_date' => $date->addDays(14),
            'end_date' => $date->addDays(44),
        ];

        $this->overview_params = [
            'title' => 'test title',
            'overview' => 'test overview',
            'tags' => [1, 2, 3]
        ];

        Storage::fake('avatars');
        $this->visual_params = [
            'visual_image_url' => [
                0 => UploadedFile::fake()->image('avatar.jpeg')
            ],
            'video_url' => 'https://www.youtube.com/watch?v=wnhvanMdx4s'
        ];

        $this->main_content_params = [
            'main_content' => 'test main content'
        ];

        $this->reward_by_total_amount_params = [
            'reward_by_total_amount' => 'test reward total amount'
        ];

        $this->reward_by_total_quantity_params = [
            'reward_by_total_quantity' => 'test reward total quantity'
        ];

        $this->identification_params = [
            'first_name' => '山田',
            'last_name' => '太郎',
            'first_name_kana' => 'ヤマダ',
            'last_name_kana' => 'タロウ',
            'phone_number' => 00000000000,
            'postal_code' => 0000000,
            'prefecture' => '東京',
            'city' => 'test city',
            'block' => 'test block',
            'building' => 'test building',
            'birth_year' => $date->year,
            'birth_month' => $date->month,
            'birth_day' => $date->day,
            'bank_code' => '0000',
            'branch_code' => '000',
            'account_type' => '普通',
            'account_number' => '0000000',
            'account_name' => 'ヤマダタロウ'
        ];

        $this->actingAs($this->user);
    }

    public function testIndexAction()
    {
        $response = $this->get(route('user.my_project.project.index'));

        $response->assertOk();
    }

    public function testCreateAction()
    {
        $response = $this->get(route('user.my_project.project.create'));

        $response->assertRedirect(route('user.my_project.project.edit', ['project' => Project::orderby('id', 'desc')->first()]));
    }

    public function testEditAction()
    {
        $response = $this->get(route('user.my_project.project.edit', ['project' => $this->my_project]));

        $response->assertOk();
    }

    public function dataProviderForTestUpdateActionForEachTab(): array
    {
        return [
            '「目標金額」更新処理' => ['target_tab', 'overview', 'target_amount_params'],
            '「概要」更新処理' => ['overview', 'visual', 'overview_params'],
            '「TOP画像」更新処理' => ['visual', 'return', 'visual_params'],
            '「PSリターン(支援総額)」更新処理' => ['ps_return', 'identification', 'reward_by_total_amount_params'],
            '「PSリターン(支援者件数)」更新処理' => ['ps_return', 'identification', 'reward_by_total_quantity_params'],
            '「本人確認」更新処理' => ['identification', 'my_project_index', 'identification_params'],
        ];
    }

    /**
     * @dataProvider dataProviderForTestUpdateActionForEachTab
     */
    public function testUpdateActionForEachTab(string $current_tab, string $next_tab, string $tab_params)
    {
        $this->withoutExceptionHandling();

        $response = $this->put(route('user.my_project.project.update', ['project' => $this->my_project, 'current_tab' => $current_tab], $this->$tab_params));

        if ($next_tab === 'my_project_index') {
            $response->assertRedirect(route('user.my_project.project.index'));
        } else {
            $response->assertRedirect(route('user.my_project.project.edit', ['project' => $this->my_project, 'next_tab' => $next_tab]));
        }
    }
}
