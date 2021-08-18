<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    protected $values = [];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => $this->faker->numberBetween(1, 50),
            'title' => Arr::random([
                '先日は、〇〇にて、プロジェクトの打ち合わせを行いました。',
                '先日は、都内某所にて〇〇の顔合わせが行われました。',
            ]),
            'content' => 'ご覧頂き有難うございます。このプロジェクトが良いなと思ったらぜひお近くの人にも紹介してください。次回をお楽しみに',
            'image_url' => 'public/sampleImage/reportImageSample.jpg',
        ];
    }

    public function init(int $count, int $project_id)
    {
        for($i = 1; $i < $count; $i++){
            $this->values[] = [
                'project_id' => $project_id,
                'title' => Arr::random([
                    '先日は、〇〇にて、プロジェクトの打ち合わせを行いました。',
                    '先日は、都内某所にて〇〇の顔合わせが行われました。',
                ]),
                'content' => 'ご覧頂き有難うございます。このプロジェクトが良いなと思ったらぜひお近くの人にも紹介してください。次回をお楽しみに',
                'image_url' => 'public/sampleImage/reportImageSample.jpg',
            ];
        }
        return $this->values;
    }
}
