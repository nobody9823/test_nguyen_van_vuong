<?php

namespace Database\Seeders;

use App\Models\TemporaryCompany;
use Illuminate\Database\Seeder;

class TemporaryCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TemporaryCompany::truncate();
        TemporaryCompany::factory(30)->create();
    }
}
