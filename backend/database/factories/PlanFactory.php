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
        return [
            'project_id' => random_int(1, 100),
            'title' => Arr::random([
                '【SS席】目標金額達成の場合は感謝ライブにご招待します',
                '【A席】目標金額達成の場合は感謝ライブにご招待します',
                '【C席】目標金額達成の場合は感謝ライブにご招待します',
            ]),
            'content' => 'ご支援いただいた方には感謝の意味を込めて渋谷〇〇にて開催の〇〇ライブのチケットを進呈させて頂きますのでスケジュール調整の上、是非渋谷〇〇にお越し頂ければ嬉しく存じます。',
            'limit_of_supporters' => $this->faker->numberBetween(50, 100),
            'delivery_date' => $this->faker->dateTimeBetween('+30days', '+90days'),
            'price' => random_int(1, 30) * 1000,
            'image_url' => 'public/sampleImage/planSample.jpg'
        ];
    }
}
