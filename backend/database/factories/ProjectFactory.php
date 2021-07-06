<?php

namespace Database\Factories;

use App\Models\Project;
use Carbon\Carbon;
use App\Enums\ProjectReleaseStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 50),
            'title' => Arr::random([
                'インフルエンサーの「やりたい」が叶う”それがファンリターン',
                'インフルエンサーの「やりたい」が叶う”それがファンリターン',
                'インフルエンサーの「やりたい」が叶う”それがファンリターン',
                'インフルエンサーの「やりたい」が叶う”それがファンリターン',
            ]),
            'content' =>
            'インフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターン',
            'release_status' => Arr::random(
                ProjectReleaseStatus::getValues()
            ),
            'curator' => $this->faker->name,
            'start_date' => $this->faker->dateTimeBetween($startDate = '2 week', $endDate = '1 month'),
            'end_date' => $this->faker->dateTimeBetween($startDate = '1 month', $endDate = '2 month'),
            'target_amount' => $this->faker->randomDigit * 100000,
        ];
    }

    public function released()
    {
        return $this->state(function () {
            return [
                'start_date' => Carbon::yesterday(),
                'end_date' => Carbon::now()->addMonth(),
                'release_status' => '掲載中',
            ];
        });
    }
}
