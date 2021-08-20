<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    public $values = [];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ];
    }

    public function valleyin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'valleyin',
                'email' => 'test@valleyin.co.jp',
                'email_verified_at' => now(),
                'password' => 'valleyin',
            ];
        });
    }

    public function init(int $count)
    {
        for ($i = 0; $i < $count; $i ++){
            $this->values[] = [
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => 'password',
                'remember_token' => Str::random(10),
            ];
        }
        return $this->values;
    }
}
