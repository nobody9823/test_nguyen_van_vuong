<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'postal_code' => $this->faker->numberBetween(1000000, 9999999),
            'prefecture_id' => $this->faker->numberBetween(1, 47),
            'city' => $this->faker->city,
            'block' => $this->faker->streetAddress,
            'building' => $this->faker->buildingNumber,
        ];
    }
}
