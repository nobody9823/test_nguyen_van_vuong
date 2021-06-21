<?php

namespace Database\Factories;

use App\Models\UserProjectLiked;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProjectLikedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProjectLiked::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'project_id' => $this->faker->numberBetween(1, 30),
        ];
    }
}
