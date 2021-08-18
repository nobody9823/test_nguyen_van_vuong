<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Report;
use App\Models\ProjectFile;
use App\Models\Tag;
use App\Models\UserProjectLiked;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\PaymentToken;
use App\Models\Curator;
use App\Models\User;
use App\Models\UserPlanBilling;
use App\Models\MessageContent;
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
        Project::insert(Project::factory()->init(30, false));
        Project::all()->each(function(Project $project){
            ProjectFile::insert(ProjectFile::factory()->init(rand(1, 10), $project->id));
            Report::insert(Report::factory()->init(rand(1, 10), $project->id));
            Plan::insert(Plan::factory()->init(rand(1, 10), $project->id));
            $project->tags()->attach(Tag::inRandomOrder()->take(rand(1, 3))->get()->pluck('id'));
            $project->likedUsers()->attach(User::inRandomOrder()->take(rand(1, 10))->get()->pluck('id'));
        });

        // 公開中
        Project::insert(Project::factory()->init(10, true));
        Project::where('release_status', '掲載中')->get()->each(function(Project $project){
            ProjectFile::insert(ProjectFile::factory()->init(rand(1, 10), $project->id));
            Report::insert(Report::factory()->init(rand(1, 10), $project->id));
            Plan::insert(Plan::factory()->init(rand(1, 10), $project->id));
            $project->tags()->attach(Tag::inRandomOrder()->take(rand(1, 3))->get()->pluck('id'));
            $project->likedUsers()->attach(User::inRandomOrder()->take(rand(1, 10))->get()->pluck('id'));
            $project->supportedUsers()->attach(User::inRandomOrder()->take(random_int(1, 10))->get()->pluck('id'));
        });
    }
}
