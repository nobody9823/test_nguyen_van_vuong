<?php

namespace Database\Factories;

use App\Models\Option;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class OptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Option::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Arr::random([
                'サイズ : M',
                'カラー : Red',
                '開催地 : 東京都〇〇区〇〇',
            ]),
            'quantity' => Arr::random([
                random_int(0, 5),
                null,
            ]),
        ];
    }
}
