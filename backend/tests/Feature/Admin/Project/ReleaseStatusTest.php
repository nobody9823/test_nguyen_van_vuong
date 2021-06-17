<?php

namespace Tests\Feature\Admin\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Talent;
use App\Models\Project;
use Artisan;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Storage;

class ReleaseStatusTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();

        $this->company = Company::factory()->state([
            'name' => 'test_company',
            'email' => 'test@example.com',
            'password' => 'password',
        ])->create();

        $this->talent = Talent::factory()
            ->state(
            [
                'company_id' => $this->company->id,
                'name' => 'test_talent_first',
                'email' => 'talent_first@example.com',
            ])->create();

        $this->projects = Project::factory()
        ->count(5)
        ->state(new Sequence(
            [
                'talent_id' => $this->talent->id,
                'title' => 'test_project_title_first',
                'explanation' => 'test_project_explanation_first',
                'release_status' => '---',
                'start_date' => now(),
                'end_date' => now(),
                'target_amount' => 100000,
            ],
            [
                'talent_id' => $this->talent->id,
                'title' => 'test_project_title_second',
                'explanation' => 'test_project_explanation_second',
                'release_status' => '承認待ち',
                'start_date' => now(),
                'end_date' => now(),
                'target_amount' => 100000,
            ],
            [
                'talent_id' => $this->talent->id,
                'title' => 'test_project_title_second',
                'explanation' => 'test_project_explanation_second',
                'release_status' => '掲載中',
                'start_date' => now(),
                'end_date' => now(),
                'target_amount' => 100000,
            ],
            [
                'talent_id' => $this->talent->id,
                'title' => 'test_project_title_second',
                'explanation' => 'test_project_explanation_second',
                'release_status' => '掲載停止中',
                'start_date' => now(),
                'end_date' => now(),
                'target_amount' => 100000,
            ],
            [
                'talent_id' => $this->talent->id,
                'title' => 'test_project_title_third',
                'explanation' => 'test_project_explanation_third',
                'release_status' => '差し戻し',
                'start_date' => now(),
                'end_date' => now(),
                'target_amount' => 100000,
            ]
        ))->create();
    }

    public function testProjectApprovedIsSuccessAsPending()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->admin, 'admin')
            ->from(route('admin.project.show', ['project' => $this->projects[1]]))
            ->get(route('admin.project.approved', ['project' => $this->projects[1]]));

        $response->assertRedirect(route('admin.project.show', ['project' => $this->projects[1]]));
        $response->assertSessionHas('flash_message', '掲載しました。');
    }

    public function testProjectApprovedIsSuccessAsUnderSuspension()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->admin, 'admin')
            ->from(route('admin.project.show', ['project' => $this->projects[3]]))
            ->get(route('admin.project.approved', ['project' => $this->projects[3]]));

        $response->assertRedirect(route('admin.project.show', ['project' => $this->projects[3]]));
        $response->assertSessionHas('flash_message', '掲載しました。');
    }

    public function testProjectSendBackIsSuccess()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->admin, 'admin')
            ->from(route('admin.project.show', ['project' => $this->projects[1]]))
            ->get(route('admin.project.send_back', ['project' => $this->projects[1]]));

        $response->assertRedirect(route('admin.project.show', ['project' => $this->projects[1]]));
        $response->assertSessionHas('flash_message', '差し戻しが完了しました。');
    }

    public function testProjectUnderSuspensionIsSuccess()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->admin, 'admin')
            ->from(route('admin.project.show', ['project' => $this->projects[2]]))
            ->get(route('admin.project.under_suspension', ['project' => $this->projects[2]]));

        $response->assertRedirect(route('admin.project.show', ['project' => $this->projects[2]]));
        $response->assertSessionHas('flash_message', '掲載停止しました。');
    }
}