<?php

namespace Tests\Unit\Models;

use App\Models\Company;
use App\Models\User;
use App\Models\Talent;
use App\Models\Project;
use App\Models\Plan;
use App\Models\ProjectImage;
use App\Models\ProjectVideo;
use App\Models\UserProjectLiked;
use App\Models\UserPlanCheering;
use App\Models\UserSupporterCommentLiked;
use App\Models\RepliesToSupporterComment;
use App\Models\ActivityReportImage;
use App\Models\SupporterComment;
use App\Models\ActivityReport;
use App\Models\Option;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->company = Company::create([
                'name' => 'valleyin',
                'email' => 'test@valleyin.co.jp',
                'password' => 'valleyin',
                'image_url' => 'public/image/companySample.jpg'
            ]);

        $this->user = User::create([
                    'name' => 'test user',
                    'email' => 'test@valleyin.co.jp',
                    'password' => 'valleyin',
                ]);

        $this->talent = $this->company->talents()->create([
                    'name' => 'talent',
                    'email' => 'talent@talent.co.jp',
                    'email_verified_at' => now(),
                    'password' => 'talent',
                    'image_url' => 'public/image/projectImageSample.jpg',
                    'remember_token' => Str::random(10),
                ]);

        $this->projects = Project::factory()
        ->count(5)
        ->state(new Sequence(
            [
                'talent_id' => $this->talent->id,
                'title' => 'test_project_title_first',
                'explanation' => 'test_project_explanation_first',
                'release_status' => '---',
                'start_date' => now()->addWeek(1),
                'end_date' => now()->addWeek(4),
                'target_amount' => 100000,
            ],
            [
                'talent_id' => $this->talent->id,
                'title' => 'test_project_title_second',
                'explanation' => 'test_project_explanation_second',
                'release_status' => '承認待ち',
                'start_date' => now()->addWeek(1),
                'end_date' => now()->addWeek(5),
                'target_amount' => 100000,
            ],
            [
                'talent_id' => $this->talent->id,
                'title' => 'test_project_title_third',
                'explanation' => 'test_project_explanation_third',
                'release_status' => '掲載中',
                'start_date' => now()->subWeek(1),
                'end_date' => now()->addWeek(1),
                'target_amount' => 100000,
            ],
            [
                'talent_id' => $this->talent->id,
                'title' => 'test_project_title_forth',
                'explanation' => 'test_project_explanation_forth',
                'release_status' => '掲載停止中',
                'start_date' => now()->subWeek(1),
                'end_date' => now()->addWeek(2),
                'target_amount' => 100000,
            ],
            [
                'talent_id' => $this->talent->id,
                'title' => 'test_project_title_fifth',
                'explanation' => 'test_project_explanation_fifth',
                'release_status' => '差し戻し',
                'start_date' => now()->addWeek(1),
                'end_date' => now()->addWeek(3),
                'target_amount' => 100000,
            ]
        ))->create();
        
        $this->project_image = $this->projects[0]->projectImages()->saveMany(ProjectImage::factory(1)->make())->first();

        $this->project_video = $this->projects[0]->projectVideo()->save(ProjectVideo::factory()->make());

        $this->plan = $this->projects[0]->plans()->saveMany(Plan::factory(1)->make())->first();
        
        $this->user_plan_cheering = UserPlanCheering::factory()->state([
            'user_id' => $this->user->id,
            'plan_id' => $this->plan->id
        ])->create();

        $this->option = Option::factory()->state([
            'plan_id' => $this->plan->id
        ])->create();

        $this->user_project_liked = UserProjectLiked::create([
            'user_id' => $this->user->id,
            'project_id' => $this->projects[0]->id
        ]);

        $this->supporter_comment = $this->projects[0]->supporterComments()->saveMany(SupporterComment::factory(1)->make())->first();

        $this->user_supporter_comment_liked = UserSupporterCommentLiked::factory()->state([
            'supporter_comment_id' => $this->supporter_comment->id,
            'user_id' => $this->user->id
        ])->create();

        $this->replies_to_user_comment = RepliesToSupporterComment::factory()->state([
            'supporter_comment_id' => $this->supporter_comment->id,
            'talent_id' => $this->talent->id
        ])->create();

        $this->activity_report = $this->projects[0]->activityReports()->saveMany(ActivityReport::factory(1)->make())->first();

        $this->activity_report_image = ActivityReportImage::factory()->state([
            'activity_report_id' => $this->activity_report->id
        ])->create();
    }

    public function testSoftDeleteIsSuccess()
    {
        $this->actingAs($this->company);

        $project_id = $this->projects[0]->id;

        $this->projects[0]->delete();
        $deletedProject = Project::onlyTrashed()->where('id', $project_id)->get();
        $deletedPlan = Plan::onlyTrashed()->where('project_id', $project_id)->get();
        $deletedUserPlanCheering = UserPlanCheering::onlyTrashed()->where('plan_id', $deletedPlan->first()->id)->get();
        $deletedOption = Option::onlyTrashed()->where('plan_id', $deletedPlan->first()->id)->get();
        $deletedProjectImage = ProjectImage::onlyTrashed()->where('project_id', $project_id)->get();
        $deletedProjectVideo = ProjectVideo::onlyTrashed()->where('project_id', $project_id)->get();
        $deletedUserProjectLiked = UserProjectLiked::onlyTrashed()->where('project_id', $project_id)->get();
        $deletedSupporterComment = SupporterComment::onlyTrashed()->where('project_id', $project_id)->get();
        $deletedUserSupporterCommentLiked = UserSupporterCommentLiked::onlyTrashed()->where('supporter_comment_id', $deletedSupporterComment->first()->id)->get();
        $deletedRepliesToSupporterComment = RepliesToSupporterComment::onlyTrashed()->where('supporter_comment_id', $deletedSupporterComment->first()->id)->get();
        $deletedActivityReport = ActivityReport::onlyTrashed()->where('project_id', $project_id)->get();
        $deletedActivityReportImage = ActivityReportImage::onlyTrashed()->where('activity_report_id', $deletedActivityReport->first()->id)->get();

        $this->assertCount(1, $deletedProject);
        $this->assertCount(1, $deletedPlan);
        $this->assertCount(1, $deletedUserPlanCheering);
        $this->assertCount(1, $deletedOption);
        $this->assertCount(1, $deletedProjectImage);
        $this->assertCount(1, $deletedProjectVideo);
        $this->assertCount(1, $deletedUserProjectLiked);
        $this->assertCount(1, $deletedSupporterComment);
        $this->assertCount(1, $deletedUserSupporterCommentLiked);
        $this->assertCount(1, $deletedRepliesToSupporterComment);
        $this->assertCount(1, $deletedActivityReport);
        $this->assertCount(1, $deletedActivityReportImage);
    }

    public function testScopeGetReleasedProject()
    {
        $this->actingAs($this->company);
        $companies = Project::getReleasedProject()->get();
        $this->assertCount(1, $companies);
    }
    // ------------------ プロジェクト検索関係 ------------------
    // 募集中のプロジェクト(新着順で使用)
    public function testScopeSeeking()
    {
        $seeking = Project::seeking()->get();
        $this->assertCount(2, $seeking);
    }
    // 終了日が近い順のプロジェクト
    public function testOrderByNearlyDeadline()
    {
        $order_by_nearly_deadline  = Project::orderByNearlyDeadline()->get();
        $this->assertEquals('test_project_title_third', $order_by_nearly_deadline[0]->title);
        $this->assertEquals('test_project_title_forth', $order_by_nearly_deadline[1]->title);
        $this->assertEquals('test_project_title_fifth', $order_by_nearly_deadline[2]->title);
        $this->assertEquals('test_project_title_first', $order_by_nearly_deadline[3]->title);
        $this->assertEquals('test_project_title_second', $order_by_nearly_deadline[4]->title);
    }

    public function testScopeWithReleaseStatusAsDefalutStatus()
    {
        $data = [
            0 => '---'
        ];
        $this->actingAs($this->company);
        $projects = Project::searchWithReleaseStatus($data)->get();
        $this->assertCount(1, $projects);
    }

    public function testScopeWithReleaseStatusAsPendingStatus()
    {
        $data = [
            0 => '承認待ち'
        ];
        $this->actingAs($this->company);
        $projects = Project::searchWithReleaseStatus($data)->get();
        $this->assertCount(1, $projects);
    }

    public function testScopeWithReleaseStatusAsPublishedStatus()
    {
        $data = [
            0 => '掲載中'
        ];
        $this->actingAs($this->company);
        $projects = Project::searchWithReleaseStatus($data)->get();
        $this->assertCount(1, $projects);
    }

    public function testScopeWithReleaseStatusAsUnderSuspensionStatus()
    {
        $data = [
            0 => '掲載停止中'
        ];
        $this->actingAs($this->company);
        $projects = Project::searchWithReleaseStatus($data)->get();
        $this->assertCount(1, $projects);
    }

    public function testScopeWithReleaseStatusAsSendBackStatus()
    {
        $data = [
            0 => '差し戻し'
        ];
        $this->actingAs($this->company);
        $projects = Project::searchWithReleaseStatus($data)->get();
        $this->assertCount(1, $projects);
    }
}
