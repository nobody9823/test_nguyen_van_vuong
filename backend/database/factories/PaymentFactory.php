<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Traits\UniqueToken;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plan_id' => $this->faker->numberBetween(1, 30),
            'user_id' => $this->faker->numberBetween(1, 100),
            'inviter_id' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(1000, 50000),
            'message_status' => 'ステータスなし',
            'merchant_payment_id' => UniqueToken::getToken(),
            'pay_jp_id' => UniqueToken::getToken(),
            'payment_is_finished' => $this->faker->boolean(50)
        ];
    }
}
