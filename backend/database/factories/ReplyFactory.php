<?php

namespace Database\Factories;

use App\Models\Reply;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_id' => $this->faker->numberBetween(1, 30),
            'content' => Arr::random([
                '頑張ってください！',
                'みんなで乗り越えましょう',
                'お手伝いできることがあればなんでもやります！',
                'たくさんの人の希望の詰まったプロジェクトになる事を願っています。',
            ]),
        ];
    }
}
