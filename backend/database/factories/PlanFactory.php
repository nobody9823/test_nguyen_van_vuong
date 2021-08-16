<?php

namespace Database\Factories;

use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $limit_of_supporters_is_required = $this->faker->boolean(50);
        return [
            'project_id' => random_int(1, 100),
            'title' => Arr::random([
                'インフルエンサーの「やりたい」が叶う”それがファンリターン',
                'インフルエンサーの「やりたい」が叶う”それがファンリターン',
                'インフルエンサーの「やりたい」が叶う”それがファンリターン',
            ]),
            'content' => 'インフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターン',
            'limit_of_supporters' => $limit_of_supporters_is_required ? $this->faker->numberBetween(50, 100) : 1,
            'delivery_date' => $this->faker->dateTimeBetween('+30days', '+90days'),
            'price' => random_int(1, 30) * 1000,
            'image_url' => 'public/sampleImage/now_printing.png',
            'address_is_required' => $this->faker->boolean(50),
            'limit_of_supporters_is_required' => $limit_of_supporters_is_required,
        ];
    }
}
