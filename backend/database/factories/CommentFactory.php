<?php

namespace Database\Factories;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    protected $values = [];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => $this->faker->numberBetween(1, 40),
            'user_id' => $this->faker->numberBetween(1, 100),
            'content' => Arr::random([
                '頑張ってください！',
                'みんなで乗り越えましょう',
                'お手伝いできることがあればなんでもやります！',
                'たくさんの人の希望の詰まったプロジェクトになる事を願っています。',
            ]),
        ];
    }

    public function init(int $count, int $user_id)
    {
        for ($i = 0; $i < $count; $i++) {
            $this->values[] = [
                'project_id' => $this->faker->numberBetween(1, 40),
                'user_id' => $user_id,
                'content' => Arr::random([
                    '頑張ってください！',
                    'みんなで乗り越えましょう',
                    'お手伝いできることがあればなんでもやります！',
                    'たくさんの人の希望の詰まったプロジェクトになる事を願っています。',
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        return $this->values;
    }
}
