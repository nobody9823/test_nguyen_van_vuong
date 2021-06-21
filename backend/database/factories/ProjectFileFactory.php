<?php

namespace Database\Factories;

use App\Models\ProjectFile;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectFile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => $this->faker->numberBetween(1, 50),
            'file_url' => 'public/sampleImage/now_printing.png',
            'file_content_type' => Arr::random([
                'image_url',
                'video_url'
            ])
        ];
    }
}
