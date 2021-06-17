<?php

namespace Database\Factories;

use App\Models\SupporterComment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class SupporterCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SupporterComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => random_int(1, 100),
            'user_id' => random_int(1, 100),
            'content' => Arr::random([
                    '頑張ってください！',
                    'みんなで乗り越えましょう',
                    'お手伝いできることがあればなんでもやります！',
                    'たくさんの人の希望の詰まったプロジェクトになる事を願っています。',
                ]),
            'created_at' => $this->faker->dateTimeBetween('now', '+90days'),
        ];
    }
}
