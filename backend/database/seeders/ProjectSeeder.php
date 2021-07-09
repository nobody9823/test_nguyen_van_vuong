<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Report;
use App\Models\ProjectFile;
use App\Models\ProjectTagTagging;
use App\Models\UserProjectLiked;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\PaymentToken;
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
            ->each(function (Project $project) {
                $project->projectFiles()->saveMany(ProjectFile::factory(rand(1, 10))->make());
                $project->reports()->saveMany(Report::factory(rand(1, 10))->make());
                $project->plans()->saveMany(Plan::factory(rand(1, 10))->make())->each(function (Plan $plan) {
                    $plan->includedPayments()->attach(Payment::inRandomOrder()->first()->id);
                });
                $project->projectTagTagging()->saveMany(ProjectTagTagging::factory(rand(1, 5))->create());
                $project->comments()->saveMany(Comment::factory(rand(1, 5))->hasReply()->create());
                $project->likedUsers()->attach(User::inRandomOrder()->take(rand(1, 10))->get()->pluck('id'));
            });

        // 公開中
        Project::factory(10)->released()->create()
            ->each(function (Project $project) {
                $project->projectFiles()->saveMany(ProjectFile::factory(rand(1, 10))->make());
                $project->reports()->saveMany(Report::factory(rand(1, 10))->make());
                $project->plans()->saveMany(Plan::factory(rand(1, 10))->make())->each(function (Plan $plan) {
                    // $plan->includedPayments()->attach(Payment::inRandomOrder()->first()->id);
                    $plan->includedPayments()->save(Payment::factory()->make())
                        ->each(function(Payment $payment){
                            $payment->token()->save(PaymentToken::factory()->make());
                        });
                });
                $project->projectTagTagging()->saveMany(ProjectTagTagging::factory(rand(1, 5))->create());
                $project->comments()->saveMany(Comment::factory(rand(1, 5))->hasReply()->create());
                $project->likedUsers()->attach(User::inRandomOrder()->take(rand(1, 10))->get()->pluck('id'));
            });
    }
}
