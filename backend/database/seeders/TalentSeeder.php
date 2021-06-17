<?php

namespace Database\Seeders;

use App\Models\Talent;
use Illuminate\Database\Seeder;

class TalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //今は使用していないが、会社に属さないtalentが存在する使用なら必要なため保持
        Talent::truncate();
        Talent::create([
            'company_id' => 1,
            'name' => 'talent',
            'email' => 'talent@talent.co.jp',
            'password' => 'talent',
            'image_url' => 'public/image/projectImageSample.jpg',
        ]);
        Talent::factory(50)->create();

    }
}
