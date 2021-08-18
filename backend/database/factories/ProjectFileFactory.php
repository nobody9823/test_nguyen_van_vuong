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

    protected $values = [];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image_file = [
            'file_url' => 'public/sampleImage/now_printing.png',
            'file_content_type' => 'image_url',
        ];
        $video_file = [
            'file_url' => 'https://www.youtube.com/watch?v=HB4QrJyWqEw',
            'file_content_type' => 'video_url',
        ];
        $file_faker = Arr::random([
            $image_file,
            $video_file
        ]);
        return [
            'project_id' => $this->faker->numberBetween(1, 50),
            'file_url' => $file_faker['file_url'],
            'file_content_type' => $file_faker['file_content_type'],
        ];
    }

    public function init(int $count, int $project_id)
    {

        $image_file = [
            'file_url' => 'public/sampleImage/now_printing.png',
            'file_content_type' => 'image_url',
        ];

        $video_file = [
            'file_url' => 'https://www.youtube.com/watch?v=HB4QrJyWqEw',
            'file_content_type' => 'video_url',
        ];

        $file_faker = Arr::random([
            $image_file,
            $video_file
        ]);

        for ($i = 0; $i < $count; $i ++){
            $this->values[] = [
                'project_id' => $project_id,
                'file_url' => $file_faker['file_url'],
                'file_content_type' => $file_faker['file_content_type'],
            ];
        }
        return $this->values;
    }
}
