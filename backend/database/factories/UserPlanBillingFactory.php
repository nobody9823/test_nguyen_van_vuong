<?php

namespace Database\Factories;

use App\Traits\UniqueToken;
use App\Models\UserPlanBilling;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'address_id' => $this->faker->numberBetween(1, 100),
            'message_status' => 'ステータスなし',
            'merchant_payment_id' => UniqueToken::getToken(),
            'pay_jp_id' => UniqueToken::getToken(),
            'payment_is_finished' => $this->faker->boolean(50),
        ];
    }
}
