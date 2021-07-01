<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\User;
use App\Traits\UniqueToken;
use App\Models\UserPlanBilling;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class UserPlanBillingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPlanBilling::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'inviter_id' => $this->faker->numberBetween(1, 100),
            'plan_id' => $this->faker->numberBetween(1, 30),
            'message_status' => 'ステータスなし',
            'merchant_payment_id' => UniqueToken::getToken(),
            'pay_jp_id' => UniqueToken::getToken(),
            'payment_is_finished' => $this->faker->boolean(50),
        ];
    }

    public function seeding()
    {
        return $this->state(function () {
            return [
                'user_id' => User::inRandomOrder()->first()->id,
                'plan_id' => Plan::inRandomOrder()->first()->id,
                'inviter_id' => Arr::random([
                    User::inRandomOrder()->first()->id,
                    null,
                ]),
            ];
        });
    }
}
