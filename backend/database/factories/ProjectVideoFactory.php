<?php

namespace Database\Factories;

use App\Models\ProjectVideo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectVideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectVideo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => $this->faker->numberBetween(1, 100),
            'video_url' => 'https://www.youtube.com/watch?v=C0DPdy98e4c'
        ];
    }
}
