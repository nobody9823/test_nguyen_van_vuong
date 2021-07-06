<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        $now = Carbon::now();
        DB::table('tags')->insert([
            ['name' => 'ライブ配信', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ブロガー', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'YouTuber', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Instagrammer', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '美容・コスメ', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '旅行', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'グルメ', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ビジネス', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ファミリー', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'スポーツ', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
