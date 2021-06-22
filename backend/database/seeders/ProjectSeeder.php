<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Report;
use App\Models\ProjectFile;
use App\Models\ProjectTagTagging;
use App\Models\UserProjectLiked;
use App\Models\Plan;
use App\Models\Comment;
use App\Models\User;
use App\Models\UserPlanBilling;
use App\Models\MessageContent;
use App\Models\Reply;
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
                    $plan->userPlanBilling()->saveMany(UserPlanBilling::factory(random_int(3, 10))->make())
                        ->each(function(UserPlanBilling $user_plan_billing){
                            $user_plan_billing->messageContents()->saveMany(MessageContent::factory(rand(1, 10))->create());
                        });
                });
                $project->projectTagTagging()->saveMany(ProjectTagTagging::factory(rand(1, 5))->create());
                $project->comments()->saveMany(Comment::factory(rand(1, 5))->create())
                ->each(function(Comment $comment){
                    $comment->replies()->saveMany(Reply::factory(rand(1, 5))->create());
                });
                $project->usersProjectLiked()->attach(User::inRandomOrder()->first()->id);
            });
    }
}
