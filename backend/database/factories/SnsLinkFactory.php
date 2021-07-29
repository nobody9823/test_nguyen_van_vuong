<?php

namespace Database\Factories;

use App\Models\SnsLink;
use Illuminate\Database\Eloquent\Factories\Factory;

class SnsLinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SnsLink::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'twitter_url' => 'https://twitter.com/',
            'instagram_url' => 'https://www.instagram.com/',
            'youtube_url' => 'https://www.youtube.com/',
            'tiktok_url' => 'https://www.tiktok.com/',
            'other_url' => 'https://readouble.com/',
        ];
    }
}
