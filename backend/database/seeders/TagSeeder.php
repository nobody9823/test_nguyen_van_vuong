<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Sequence;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();
        
        Tag::factory()->count(10)->state(new Sequence
        (
            ['name' => 'ライバー'],
            ['name' => 'ブロガー'],
            ['name' => 'Youtuber'],
            ['name' => 'Instagramer'],
            ['name' => '美容・コスメ'],
            ['name' => '旅行'],
            ['name' => 'スポーツ'],
            ['name' => 'ファミリー'],
            ['name' => 'グッズ'],
            ['name' => 'グルメ'],
        ))->create();
    }
}
