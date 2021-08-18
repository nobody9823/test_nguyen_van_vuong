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

    protected $values = [];
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
            'reward_by_total_amount' =>
            'インフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターン',
            'reward_by_total_quantity' =>
            'インフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターン',
            'release_status' => Arr::random(
                ProjectReleaseStatus::getValues()
            ),
            'start_date' => $this->faker->dateTimeBetween($startDate = '2 week', $endDate = '1 month'),
            'end_date' => $this->faker->dateTimeBetween($startDate = '1 month', $endDate = '2 month'),
            'target_amount' => $this->faker->numberBetween(10000, 99999999),
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

    public function init(int $count = 1)
    {
        for ($i = 0; $i < $count; $i ++){
            $this->values[] = [
                'user_id' => $this->faker->numberBetween(1, 50),
                'curator_id' => $this->faker->numberBetween(1, 10),
                'title' => Arr::random([
                    'インフルエンサーの「やりたい」が叶う”それがファンリターン',
                    'インフルエンサーの「やりたい」が叶う”それがファンリターン',
                    'インフルエンサーの「やりたい」が叶う”それがファンリターン',
                    'インフルエンサーの「やりたい」が叶う”それがファンリターン',
                ]),
                'content' =>
                'インフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターン',
                'reward_by_total_amount' =>
                'インフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターン',
                'reward_by_total_quantity' =>
                'インフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターンインフルエンサーの「やりたい」が叶う”それがファンリターン',
                'start_date' => Carbon::yesterday(),
                'end_date' => Carbon::now()->addMonth(),
                'release_status' => rand(0, 1) ? '掲載中' : Arr::random(
                    ProjectReleaseStatus::getValues()
                ),
                'target_amount' => $this->faker->numberBetween(10000, 99999999),
            ];
        }
        return $this->values;
    }
}
