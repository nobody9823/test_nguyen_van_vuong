<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'is_released' => $this->faker->boolean(50),
            'remarks' => $this->faker->realText(200),
        ];
    }
    public function valleyin()
    {
        return $this->state(
            [
                'name' => '所属なし',
                'email' => 'test@nobelongs.co.jp',
                'password' => 'valleyin',
                'image_url' => 'public/image/companySample.jpg'
            ]
        );
    }
}
