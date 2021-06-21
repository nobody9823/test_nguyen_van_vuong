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
            'birthday' => $this->faker->dateTimeBetween('+15year', '+30year')->format('Y-m-d H:i'),
            'gender' => Arr::random([
                '男性',
                '女性',
                'その他'
            ]),
            'introduction' => $this->faker->realText(50),
            'phone_number' => $this->faker->phoneNumber,
            'birthday_is_published' => $this->faker->boolean(50),
            'gender_is_published' => $this->faker->boolean(50),
            'image_url' => $this->faker->imageUrl,
            'remember_token' => Str::random(10),
            'inviter_code' => $this->faker->numberBetween(10000, 99999)
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
                'birthday' => $this->faker->dateTimeBetween('+15year', '+30year')->format('Y-m-d H:i'),
                'gender' => Arr::random([
                    '男性',
                    '女性',
                    'その他'
                ]),
                'introduction' => $this->faker->realText(50),
                'birthday_is_published' => $this->faker->boolean(50),
                'gender_is_published' => $this->faker->boolean(50),
                'image_url' => $this->faker->imageUrl,
                'inviter_code' => $this->faker->numberBetween(10000, 99999)
            ];
        });
    }
}
