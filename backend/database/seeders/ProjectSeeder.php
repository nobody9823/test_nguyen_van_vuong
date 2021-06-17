<?php

namespace Database\Seeders;

use App\Models\ActivityReport;
use App\Models\ActivityReportImage;
use App\Models\Option;
use App\Models\Plan;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectVideo;
use App\Models\RepliesToSupporterComment;
use App\Models\SupporterComment;
use App\Models\User;
use App\Models\UserPlanCheering;
use App\Models\UserSupporterCommentLiked;
use App\Models\UserProjectLiked;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::truncate();

        // 公開１ヶ月前、明日終了
        Project::factory(30)
            ->state(['start_date' => Carbon::now()->subMonth(), 'end_date' => Carbon::now()->tomorrow()])
            ->create()
            ->each(function ($project) {
                $project->projectImages()->saveMany(ProjectImage::factory(3)->make());
                $project->projectVideo()->save(ProjectVideo::factory()->make());
                $project->plans()->saveMany(Plan::factory(random_int(1, 5))->make())
                    ->each(function ($plan) {
                        $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::now()])->make());
                        $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::tomorrow()])->make());
                        $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::yesterday()])->make());
                        $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::now()->next(Carbon::MONDAY)])->make());
                        $plan->options()->saveMany(Option::factory(2)->make());
                    });

                $project->plans()->saveMany(ActivityReport::factory(random_int(1, 5))
                        ->make())
                    ->each(function ($activityReport) {
                        $activityReport->activityReportImages()->saveMany(ActivityReportImage::factory(random_int(1, 3))->make());
                    });

                $project->supporterComments()->saveMany(SupporterComment::factory(3)->make())
                    ->each(function ($supporterComment) use ($project) {
                        $supporterComment->repliesToSupporterComment()->saveMany(RepliesToSupporterComment::factory(1)->state(['talent_id' => $project->talent->id])->make());
                        $supporterComment->userSupporterCommentLiked()->saveMany(UserSupporterCommentLiked::factory(random_int(3, 5))->make());
                    });
                    
                $project->userProjectLiked()->saveMany(UserProjectLiked::factory(random_int(3, 10))->make());
            });

        Project::factory(30)
        ->create()
        ->each(function ($project) {
            $project->projectImages()->saveMany(ProjectImage::factory(3)->make());
            $project->projectVideo()->save(ProjectVideo::factory()->make());
            $project->plans()->saveMany(Plan::factory(random_int(1, 5))->make())
                ->each(function ($plan) {
                    $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::now()])->make());
                    $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::tomorrow()])->make());
                    $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::yesterday()])->make());
                    $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::now()->next(Carbon::MONDAY)])->make());
                    $plan->options()->saveMany(Option::factory(2)->make());
                });

            $project->plans()->saveMany(ActivityReport::factory(random_int(1, 5))
                    ->make())
                ->each(function ($activityReport) {
                    $activityReport->activityReportImages()->saveMany(ActivityReportImage::factory(random_int(1, 3))->make());
                });

            $project->supporterComments()->saveMany(SupporterComment::factory(3)->make())
                ->each(function ($supporterComment) use ($project) {
                    $supporterComment->repliesToSupporterComment()->saveMany(RepliesToSupporterComment::factory(1)->state(['talent_id' => $project->talent->id])->make());
                    $supporterComment->userSupporterCommentLiked()->saveMany(UserSupporterCommentLiked::factory(random_int(3, 5))->make());
                });

            $project->userProjectLiked()->saveMany(UserProjectLiked::factory(random_int(3, 10))->make());
        });

        // 明日公開
        Project::factory(30)
            ->state(['start_date' => Carbon::now()->tomorrow()])
            ->create()
            ->each(function ($project) {
                $project->projectImages()->saveMany(ProjectImage::factory(3)->make());
                $project->projectVideo()->save(ProjectVideo::factory()->make());
                $project->plans()->saveMany(Plan::factory(random_int(1, 5))->make())
                    ->each(function ($plan) {
                        $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::now()])->make());
                        $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::tomorrow()])->make());
                        $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::yesterday()])->make());
                        $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::now()->next(Carbon::MONDAY)])->make());
                        $plan->options()->saveMany(Option::factory(2)->make());
                    });

                $project->plans()->saveMany(ActivityReport::factory(random_int(1, 5))
                        ->make())
                    ->each(function ($activityReport) {
                        $activityReport->activityReportImages()->saveMany(ActivityReportImage::factory(random_int(1, 3))->make());
                    });

                $project->supporterComments()->saveMany(SupporterComment::factory(3)->make())
                    ->each(function ($supporterComment) use ($project) {
                        $supporterComment->repliesToSupporterComment()->saveMany(RepliesToSupporterComment::factory(1)->state(['talent_id' => $project->talent->id])->make());
                        $supporterComment->userSupporterCommentLiked()->saveMany(UserSupporterCommentLiked::factory(random_int(3, 5))->make());
                    });

                $project->userProjectLiked()->saveMany(UserProjectLiked::factory(random_int(3, 10))->make());
            });

            // 公開１ヶ月前、前日終了
        Project::factory(30)
        ->state(['start_date' => Carbon::now()->subMonth(), 'end_date' => Carbon::now()->yesterday()])
        ->create()
        ->each(function ($project) {
            $project->projectImages()->saveMany(ProjectImage::factory(3)->make());
            $project->projectVideo()->save(ProjectVideo::factory()->make());
            $project->plans()->saveMany(Plan::factory(random_int(1, 5))->make())
                ->each(function ($plan) {
                    $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::now()])->make());
                    $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::tomorrow()])->make());
                    $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::yesterday()])->make());
                    $plan->userPlanCheering()->save(UserPlanCheering::factory()->state(['created_at' => Carbon::now()->next(Carbon::MONDAY)])->make());
                    $plan->options()->saveMany(Option::factory(2)->make());
                });

            $project->plans()->saveMany(ActivityReport::factory(random_int(1, 5))
                    ->make())
                ->each(function ($activityReport) {
                    $activityReport->activityReportImages()->saveMany(ActivityReportImage::factory(random_int(1, 3))->make());
                });

            $project->supporterComments()->saveMany(SupporterComment::factory(3)->make())
                ->each(function ($supporterComment) use ($project) {
                    $supporterComment->repliesToSupporterComment()->saveMany(RepliesToSupporterComment::factory(1)->state(['talent_id' => $project->talent->id])->make());
                    $supporterComment->userSupporterCommentLiked()->saveMany(UserSupporterCommentLiked::factory(random_int(3, 5))->make());
                });

            $project->userProjectLiked()->saveMany(UserProjectLiked::factory(random_int(3, 10))->make());
        });
    }
}
