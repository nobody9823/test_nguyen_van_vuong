<?php

namespace Tests\Unit\Models;

use App\Models\Company;
use App\Models\Talent;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectImage;
use App\Models\ProjectVideo;
use App\Models\UserProjectLiked;
use App\Models\Plan;
use App\Models\UserPlanCheering;
use App\Models\ActivityReport;
use App\Models\ActivityReportImage;
use App\Models\Option;
use App\Models\RepliesToSupporterComment;
use App\Models\SupporterComment;
use App\Models\UserSupporterCommentLiked;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class TalentTest extends TestCase
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

        $this->talent = $this->company->talents()->create([
                    'name' => 'talent',
                    'email' => 'talent@talent.co.jp',
                    'email_verified_at' => now(),
                    'password' => 'talent',
                    'image_url' => 'public/image/projectImageSample.jpg',
                    'remember_token' => Str::random(10),
                ]);

        $this->user = User::factory()->state([
            'name' => 'test user',
            'email' => 'test_user_first@example.com',
        ])->create();

        $this->project = $this->talent->projects()->saveMany(Project::factory(1)->make())->first();

        $this->projectImage = $this->project->projectImages()->saveMany(ProjectImage::factory(1)->make())->first();

        $this->project_video = $this->project->projectVideo()->save(ProjectVideo::factory()->make());

        $this->userProjectLiked = UserProjectLiked::create([
            'project_id' => $this->project->id,
            'user_id' => $this->user->id
        ]);

        $this->plan = Plan::factory()->state([
            'project_id' => $this->project
        ])->create();

        $this->userPlanCheering = UserPlanCheering::factory()->state([
            'user_id' => $this->user->id,
            'plan_id' => $this->plan->id
        ])->create();

        $this->option = Option::factory()->state([
            'plan_id' => $this->plan->id
        ])->create();

        $this->activityReport = $this->project->activityReports()->saveMany(ActivityReport::factory(1)->make())->first();

        $this->activityReportImage = ActivityReportImage::factory()->state([
            'activity_report_id' => $this->activityReport->id
        ])->create();

        $this->supporterComment = $this->project->supporterComments()->saveMany(SupporterComment::factory(1)->make())->first();

        $this->repliesToSupporterComment = RepliesToSupporterComment::factory()->count(1)->state([
            'supporter_comment_id' => $this->supporterComment->id,
            'talent_id' => $this->talent->id,
            'content' => "test content",
        ])->create();

        $this->userSupporterCommentLiked = UserSupporterCommentLiked::factory()->state([
            'supporter_comment_id' => $this->supporterComment->id,
        ])->create();
    }

    public function testSoftDeleteIsSuccess()
    {
        $this->actingAs($this->company);

        $talent_id = $this->talent->id;

        $this->talent->delete();

        $deletedProject = Project::onlyTrashed()->where('talent_id', $talent_id)->get();
        $deletedProjectImage = ProjectImage::onlyTrashed()->where('project_id', $deletedProject->first()->id)->get();
        $deletedProjectVideo = ProjectVideo::onlyTrashed()->where('project_id', $deletedProject->first()->id)->get();
        $deletedUserProjectLiked = UserProjectLiked::onlyTrashed()->where('project_id', $deletedProject->first()->id)->get();
        $deletedPlan = Plan::onlyTrashed()->where('project_id', $deletedProject->first()->id)->get();
        $deletedUserPlanCheering = UserPlanCheering::onlyTrashed()->where('plan_id', $deletedPlan->first()->id)->get();
        $deletedOption = Option::onlyTrashed()->where('plan_id', $deletedPlan->first()->id)->get();
        $deletedActivityReport = ActivityReport::onlyTrashed()->where('project_id', $deletedProject->first()->id)->get();
        $deletedActivityReportImage = ActivityReportImage::onlyTrashed()->where('activity_report_id', $deletedActivityReport->first()->id)->get();
        $deletedRepliesToSupporterComment = RepliesToSupporterComment::onlyTrashed()->where('talent_id', $talent_id)->get();
        $deletedSupporterComment = SupporterComment::onlyTrashed()->where('project_id', $deletedProject->first()->id)->get();
        $deletedUserSupporterCommentLiked = UserSupporterCommentLiked::onlyTrashed()->where('supporter_comment_id', $deletedSupporterComment->first()->id)->get();

        $this->assertCount(1, $deletedProject);
        $this->assertCount(1, $deletedProjectImage);
        $this->assertCount(1, $deletedProjectVideo);
        $this->assertCount(1, $deletedUserProjectLiked);
        $this->assertCount(1, $deletedPlan);
        $this->assertCount(1, $deletedUserPlanCheering);
        $this->assertCount(1, $deletedOption);
        $this->assertCount(1, $deletedActivityReport);
        $this->assertCount(1, $deletedActivityReportImage);
        $this->assertCount(1, $deletedRepliesToSupporterComment);
        $this->assertCount(1, $deletedSupporterComment);
        $this->assertCount(1, $deletedUserSupporterCommentLiked);
    }
}
