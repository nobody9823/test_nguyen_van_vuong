<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\RepliesToSupporterComment;
use App\Models\SupporterComment;
use App\Models\Talent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class RepliesToSupporterCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RepliesToSupporterComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supporter_comment_id' => random_int(1, 300),
            'talent_id' => random_int(1, 50),
            'content' => Arr::random([
              'ありがとうございます！',
              'これからもご支援よろしくお願いします！',
              '必ず乗り越えてみせます！',
            ]),
        ];
    }
}
