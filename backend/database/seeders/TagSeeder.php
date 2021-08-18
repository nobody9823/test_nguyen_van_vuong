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

        Tag::insert([
            ['name' => 'ライバー', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ブロガー', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Youtuber', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Instagramer', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '美容・コスメ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '旅行', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'スポーツ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ファミリー', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'グッズ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'グルメ', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
