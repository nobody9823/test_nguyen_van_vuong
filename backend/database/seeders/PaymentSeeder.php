<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Payment;
use App\Models\PaymentToken;
use App\Models\Plan;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::inRandomOrder()->take(rand(50, 80))->each(function (User $user) {
            $user->payments()->saveMany(Payment::factory(rand(0, 5))->has(PaymentToken::factory())->create());
        });
        Payment::all()->each(function (Payment $payment) {
            $payment->includedPlans()->attach(
                [Plan::whereIn('project_id', Project::where('id', $payment->project_id)->select('id'))->inRandomOrder()->first()->id => ['quantity' => random_int(1, 3)]]
            );
        });
    }
}
