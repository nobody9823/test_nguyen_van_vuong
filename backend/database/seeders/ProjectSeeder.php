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
use App\Models\Comment;
use App\Models\Curator;
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

        Project::factory(30)
            ->state([
                'curator_id' => rand(1, 10)
            ])->create()
            ->each(function (Project $project) {
                $project->projectFiles()->saveMany(ProjectFile::factory(rand(1, 10))->make());
                $project->reports()->saveMany(Report::factory(rand(1, 10))->make());
                $project->plans()->saveMany(Plan::factory(rand(1, 10))->make());
                $project->tags()->attach(Tag::inRandomOrder()->take(rand(1, 3))->get()->pluck('id'));
                $project->likedUsers()->attach(User::inRandomOrder()->take(rand(1, 10))->get()->pluck('id'));
            });

        // 公開中
        Project::factory(10)->released()
            ->state([
                'curator_id' => rand(1, 10)
            ])
            ->create()
            ->each(function (Project $project) {
                $project->projectFiles()->saveMany(ProjectFile::factory(10)->make());
                $project->reports()->saveMany(Report::factory(rand(1, 10))->make());
                $project->plans()->saveMany(Plan::factory(rand(1, 10))->make());
                $project->comments()->saveMany(Comment::factory(rand(1,10))->make())
                ->each(function ($comment){ $comment->reply()->saveMany(Reply::factory())->make(); });
                // $project->plans()->saveMany(Plan::factory(rand(1, 10))->make())->each(function (Plan $plan) {
                //     $plan->includedPayments()
                //         ->attach(
                //             [
                //                 Payment::factory()
                //                     ->for(User::inRandomOrder()->first())
                //                     ->has(PaymentToken::factory())->create()->id => ['quantity' => random_int(1, 3)]
                //             ]
                //         );
                // });
                $project->tags()->attach(Tag::inRandomOrder()->take(rand(1, 3))->get()->pluck('id'));
                $project->likedUsers()->attach(User::inRandomOrder()->take(rand(1, 10))->get()->pluck('id'));
                $project->supportedUsers()->attach(User::inRandomOrder()->take(random_int(1, 10))->get()->pluck('id'));
            });
    }
}
