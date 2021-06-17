<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $now = Carbon::now();
        DB::table('categories')->insert([
            ['name' => 'ネット中傷被害', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'パワハラ・セクハラ', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'レイプ被害', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '遺族損害賠償請求', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
