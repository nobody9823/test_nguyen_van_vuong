<?php

namespace Database\Factories;

use App\Models\UserPlanCheering;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Traits\UniqueToken;

class UserPlanCheeringFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPlanCheering::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'plan_id' => $this->faker->numberBetween(1, 100),
            'address_id' => $this->faker->numberBetween(1, 100),
            'phone_number' => $this->faker->numberBetween(100, 999)."-".$this->faker->numberBetween(1000, 9999)."-".$this->faker->numberBetween(1000, 9999),
            'message_status' => 'ステータスなし',
            'selected_option' => Arr::random([
                'サイズ : M',
                'カラー : Red',
                '開催地 : 東京都〇〇区〇〇',
            ]),
            'merchant_payment_id' => UniqueToken::getToken(),
            'payment_is_finished' => $this->faker->boolean(50)
        ];
    }
}
