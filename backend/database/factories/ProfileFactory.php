<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Arr;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $first_kana_name = $this->faker->firstKanaName;
        $last_kana_name = $this->faker->lastKanaName;
        return [
            'first_name_kana' => $first_kana_name,
            'last_name_kana' => $last_kana_name,
            'first_name' => mb_convert_kana($first_kana_name, 'c', 'utf-8'),
            'last_name' => mb_convert_kana($last_kana_name, 'c', 'utf-8'),
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
            'inviter_code' => $this->faker->uuid,
        ];
    }
}
