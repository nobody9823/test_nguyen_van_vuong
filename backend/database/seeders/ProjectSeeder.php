<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\ActivityReportImage;
use App\Models\Option;
use App\Models\Plan;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectVideo;
use App\Models\RepliesToSupporterComment;
use App\Models\SupporterComment;
use App\Models\User;
use App\Models\UserPlanCheering;
use App\Models\UserSupporterCommentLiked;
use App\Models\UserProjectLiked;
use App\Models\UserPlanBilling;
use App\Models\ProjectTagTagging;
use App\Models\Comment;
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

        Project::factory(30)->create()
            ->each(function(Project $project){
                $project->projectFiles()->saveMany(ProjectFile::factory(rand(1, 10))->create());
                $project->reports()->saveMany(Report::factory(rand(1, 10))->create());
                $project->plans()->saveMany(Plan::factory(rand(1, 10))->create())
                ->each(function(Plan $plan){
                    $plan->userPlanBilling()->saveMany(UserPlanBilling::factory(random_int(3, 10))->make());
                });
                $project->projectTagTagging()->saveMany(ProjectTagTagging::factory(rand(1, 5))->create());
                $project->comments()->saveMany(Comment::factory(rand(1, 5))->create());
                $project->userProjectLiked()->saveMany(UserProjectLiked::factory(random_int(3, 10))->make());
            });

    }
}
