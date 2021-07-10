<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
use App\Traits\UniqueToken;
use App\Enums\PaymentWay;
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
            'user_id' => User::inRandomOrder()->first()->id,
            'project_id' => random_int(1, 100),
            'inviter_id' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(1000, 50000),
            'message_status' => 'ステータスなし',
            'payment_way' => PaymentWay::getValues()[random_int(0, 2)],
            'payment_is_finished' => $this->faker->boolean(50),
            'remarks' => $this->faker->realText(100),
        ];
    }
}
