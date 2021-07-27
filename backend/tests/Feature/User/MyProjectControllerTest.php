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
        ->has(Identification::factory())
        ->has(Address::factory())
        ->has(Profile::factory())
        ->has(Project::factory()->released()
            ->has(
                    ProjectFile::factory()->state([
                        'file_url' => 'public/sampleImage/now_printing.png',
                        'file_content_type' => 'image_url',
                ]))
            ->has(
                Plan::factory()->state([
                    'price' => 1000
                ]))
        )->count(10)->create();

        $this->user = $this->users->first();

        $this->project = $this->user->projects()->first();

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
            'tags' => [ 1, 2, 3 ]
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

        $this->ps_return_params = [
            'ps_plan_content' => 'test ps plan content'
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
        $response = $this->get(route('user.project.index'));

        $response->assertOk();
    }

    public function testCreateAction()
    {
        $response = $this->get(route('user.project.create'));

        $response->assertOk();
    }

    public function testEditAction()
    {
        $response = $this->get(route('user.project.edit', [ 'project' => $this->project ]));

        $response->assertOk();
    }

    public function testUpdateActionWhenEditTargetAmount()
    {
        $this->withoutExceptionHandling();

        $response = $this->put(route('user.project.update', [ 'project' => $this->project, 'current_tab' => 'target_tab' ], $this->target_amount_params));

        $response->assertRedirect(route('user.project.edit', ['project' => $this->project, 'next_tab' => 'overview']));
    }

    public function testUpdateActionWhenEditOverView()
    {
        $this->withoutExceptionHandling();

        $response = $this->put(route('user.project.update', [ 'project' => $this->project, 'current_tab' => 'overview' ], $this->overview_params));

        $response->assertRedirect(route('user.project.edit', ['project' => $this->project, 'next_tab' => 'visual']));
    }

    public function testUpdateActionWhenEditVisual()
    {
        $this->withoutExceptionHandling();

        $response = $this->put(route('user.project.update', [ 'project' => $this->project, 'current_tab' => 'visual' ], $this->visual_params));

        $response->assertRedirect(route('user.project.edit', ['project' => $this->project, 'next_tab' => 'return']));
    }

    public function testUpdateActionWhenEditPsReturn()
    {
        $this->withoutExceptionHandling();

        $response = $this->put(route('user.project.update', [ 'project' => $this->project, 'current_tab' => 'ps_return' ], $this->ps_return_params));

        $response->assertRedirect(route('user.project.edit', ['project' => $this->project, 'next_tab' => 'identification']));
    }

    public function testUpdateActionWhenEditIdentification()
    {
        $this->withoutExceptionHandling();

        $response = $this->put(route('user.project.update', [ 'project' => $this->project, 'current_tab' => 'identification' ], $this->ps_return_params));

        $response->assertRedirect(route('user.project.edit', ['project' => $this->project, 'next_tab' => 'target_amount']));
    }
}
