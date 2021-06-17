<?php

namespace Database\Factories;

use App\Enums\MessageContributor;
use App\Models\MessageContent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class MessageContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MessageContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_plan_cheering_id' => random_int(1, 10),
            'content' => Arr::random([
                'はじめまして',
                'こんにちは',
                'お世話になっております',
                '本日はどうぞよろしくお願いいたします。',
                'ありがとうございました',
                '失礼いたします',
            ]),
            'file_path' => null,
            'file_original_name' => null,
            'message_contributor' => MessageContributor::getValues()[random_int(0, 3)],
            'is_read' => false,
        ];
    }
}
