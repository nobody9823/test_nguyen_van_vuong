<?php

namespace Database\Factories;

use App\Models\Curator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CuratorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Curator::class;

    protected $values = [];

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
            'remember_token' => Str::random(10)
        ];
    }

    public function valleyin()
    {
        return $this->state(function (array $attribute){
            return [
                'name' => 'valleyin',
                'email' => 'test@valleyin.co.jp',
                'email_verified_at' => now(),
                'password' => 'valleyin'
            ];
        });
    }

    public function init(int $count = 1)
    {
        for($i = 0; $i < $count; $i++){
            $this->values[] = [
                'name' => $this->faker->name,
                'email' => $this->faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => 'password',
                'remember_token' => Str::random(10)
            ];
        }
        return $this->values;
    }
}
