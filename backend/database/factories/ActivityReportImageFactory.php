<?php

namespace Database\Factories;

use App\Models\ActivityReportImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityReportImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivityReportImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'activity_report_id' => $this->faker->numberBetween(1, 100),
        ];
    }
}
