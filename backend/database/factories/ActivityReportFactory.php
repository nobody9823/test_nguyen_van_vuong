<?php

namespace Database\Factories;

use App\Models\ActivityReport;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ActivityReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivityReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => $this->faker->numberBetween(1, 10),
            'title' => Arr::random([
              '【アイドル〇〇ちゃんプロジェクト実行が決まりました！！】',
              '先日は、〇〇にて、プロジェクトの打ち合わせを行いました。',
              '先日は、都内某所にて〇〇の顔合わせが行われました。',
            ]),
            'content' => 'ご覧頂き有難うございます。このプロジェクトが良いなと思ったらぜひお近くの人にも紹介してください。次回をお楽しみに',
        ];
    }
}
