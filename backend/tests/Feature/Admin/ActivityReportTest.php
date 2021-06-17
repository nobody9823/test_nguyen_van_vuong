<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Project;
use App\Models\ActivityReport;
use App\Models\Talent;
use App\Enums\ProjectReleaseStatus;
use Illuminate\Support\Arr;
use App\Http\Controllers\Admin\ActivityReportController;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityReportTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // FIXME 複雑になってしまったのでもっと良い方法があれば...
    public function setUp() :void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();

        $this->company = Company::factory()
            ->state([
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
            ->count(3)
            ->state(new Sequence(
                [
                    'talent_id' => $this->talent->id,
                    'title' => 'test_project_title_first',
                    'explanation' => 'test_project_explanation_first',
                    'release_status' => Arr::random(
                        ProjectReleaseStatus::getValues()
                    ),
                    'start_date' => now(),
                    'end_date' => now(),
                    'target_amount' => 100000,
                ],
                [
                    'talent_id' => $this->talent->id,
                    'title' => 'test_project_title_second',
                    'explanation' => 'test_project_explanation_second',
                    'release_status' => Arr::random(
                        ProjectReleaseStatus::getValues()
                    ),
                    'start_date' => now(),
                    'end_date' => now(),
                    'target_amount' => 200000,
                ],
                [
                    'talent_id' => $this->talent->id,
                    'title' => 'test_project_title_third',
                    'explanation' => 'test_project_explanation_third',
                    'release_status' => Arr::random(
                        ProjectReleaseStatus::getValues()
                    ),
                    'start_date' => now(),
                    'end_date' => now(),
                    'target_amount' => 300000,
                ]
            ))->create();

            $this->activityReports = ActivityReport::factory()
            ->count(3)
            ->state(new Sequence([
                'project_id' => $this->projects[0]->id,
                'title' => 'test activity report first',
                'content' => 'test activity report'
            ],
            [
                'project_id' => $this->projects[1]->id,
                'title' => 'test activity report second',
                'content' => 'test activity report'
            ],
            [
                'project_id' => $this->projects[2]->id,
                'title' => 'test activity report third',
                'content' => 'test activity report'
            ]))->create();

    }

    public function testIndexActionAtActivityReport()
    {
        $response = $this->actingAs($this->admin, 'admin')
        ->get(route('admin.activity_report.index'));

        $response->assertOk();
        $response->assertSee('活動報告一覧');
    }

    public function testCreateActionAtActivityReport()
    {
        $response = $this->actingAs($this->admin, 'admin')
        ->get(route('admin.activity_report.create', ['project' => $this->projects[0]]));

        $response->assertOk();
        $response->assertSee('活動報告新規作成');
    }

    public function testStoreActionAtActivityReport()
    {
        $response = $this->actingAs($this->admin, 'admin')
        ->from(route('admin.activity_report.search', [
            'project' => $this->projects[0],
            'activity_reports' => $this->projects[0]->activityReports()->paginate(10)
        ]))
        ->post(route('admin.activity_report.store', [
            'project' => $this->projects[0],
            'title' => 'added test title',
            'content' => 'added test content'
        ]));

        $response->assertRedirect(action([ActivityReportController::class, 'search'], ['project' => $this->projects[0], 'activity_reports' => $this->projects[0]->activityReports()->paginate(10)]));
    }

    public function testShowActionAtActivityReport()
    {
        $response = $this->actingAs($this->admin, 'admin')
        ->get(route('admin.activity_report.show', [
            'project' => $this->projects[0],
            'activity_report' => $this->activityReports[0]
        ]));

        $response->assertOk();
        $response->assertSee('活動報告詳細');
    }

    public function testEditActionAtActivityReport()
    {
        $response = $this->actingAs($this->admin, 'admin')
        ->get(route('admin.activity_report.edit', ['project' => $this->projects[0], 'activity_report' => $this->activityReports[0]]));

        $response->assertOk();
        $response->assertSee('活動報告編集');
    }

    public function testUpdateActionAtActivityReport()
    {
        $response = $this->actingAs($this->admin, 'admin')
        ->from(route('admin.activity_report.search', [
            'project' => $this->projects[0],
            'activity_report' => $this->activityReports[0]
        ]))
        ->patch(route('admin.activity_report.update', [
            'project' => $this->projects[0],
            'activity_report' => $this->activityReports[0],
            'title' => 'edited test title',
            'content' => 'edited test content'
        ]));

        $response->assertRedirect(action([ActivityReportController::class, 'search'], ['project' => $this->projects[0], 'activity_reports' => $this->projects[0]->activityReports()->paginate(10)]));
    }

    public function testDestroyActionAtActivityReport()
    {
        $response = $this->actingAs($this->admin, 'admin')
        ->from(route('admin.activity_report.search', [
            'project' => $this->projects[0],
            'activity_report' => $this->activityReports[0]
        ]))
        ->delete(route('admin.activity_report.destroy', [
            'project' => $this->projects[0],
            'activity_report' => $this->activityReports[0]
        ]));

        $response->assertRedirect(action([ActivityReportController::class, 'search'], ['project' => $this->projects[0], 'activity_reports' => $this->projects[0]->activityReports()->paginate(10)]));
    }

    public function testSearchActionAtActivityReport()
    {
        $expected_data = [
            'test'
        ];

        $response = $this->actingAs($this->admin, 'admin')
        ->from(route('admin.activity_report.index'))
        ->get(route('admin.activity_report.search', ['word' => 'test']));

        $response->assertOk();
        $response->assertSeeTextInOrder($expected_data);
    }
}
