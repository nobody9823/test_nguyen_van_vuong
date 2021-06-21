<?php

namespace Database\Factories;

use App\Models\ProjectTagTagging;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectTagTaggingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectTagTagging::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => $this->faker->numberBetween(1, 50),
            'tag_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
