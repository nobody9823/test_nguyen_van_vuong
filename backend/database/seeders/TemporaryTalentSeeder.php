<?php

namespace Database\Seeders;

use App\Models\TemporaryTalent;
use Illuminate\Database\Seeder;

class TemporaryTalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TemporaryTalent::truncate();
        TemporaryTalent::factory()->state([
            'company_id' => 1,
            'name' => 'talent',
            'email' => 'talent@talent.co.jp',
            'email_verified_at' => now(),
            'password' => 'talent',
        ])->create();
        TemporaryTalent::factory(30)->create();
    }
}
