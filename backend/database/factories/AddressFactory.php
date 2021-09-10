<?php

namespace Database\Factories;

use App\Helpers\PrefectureHelper;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

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
            'prefecture' => PrefectureHelper::getPrefectures()[random_int(1, 47)],
            'city' => $this->faker->city,
            'block' => $this->faker->streetAddress,
            'block_number' => '1-1-1',
            'building' => $this->faker->buildingNumber,
        ];
    }
}
