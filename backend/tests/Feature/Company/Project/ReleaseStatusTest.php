<?php

namespace Tests\Feature\Company\Project;

use Tests\TestCase;
use App\Models\Company;
use App\Models\Talent;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ReleaseStatusTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
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

    public function testProjectApprovalRequestIsSuccessAsDefaultStatus()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->company, 'company')
            ->from(route('company.project.show', ['project' => $this->projects[0]]))
            ->get(route('company.project.approval_request', ['project' => $this->projects[0]]));

        $response->assertRedirect(route('company.project.show', ['project' => $this->projects[0]]));
        $response->assertSessionHas('flash_message', '承認申請が完了しました。');
    }

    public function testProjectApprovalRequestIsSuccessAsUnderSuspensionStatus()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->company, 'company')
            ->from(route('company.project.show', ['project' => $this->projects[3]]))
            ->get(route('company.project.approval_request', ['project' => $this->projects[3]]));

        $response->assertRedirect(route('company.project.show', ['project' => $this->projects[3]]));
        $response->assertSessionHas('flash_message', '承認申請が完了しました。');
    }

    public function testProjectApprovalRequestIsSuccessAsSendBack()
    {
        $this->withoutExceptionHandling();
        $response = $this->actingAs($this->company, 'company')
            ->from(route('company.project.show', ['project' => $this->projects[4]]))
            ->get(route('company.project.approval_request', ['project' => $this->projects[4]]));

        $response->assertRedirect(route('company.project.show', ['project' => $this->projects[4]]));
        $response->assertSessionHas('flash_message', '承認申請が完了しました。');
    }
}
