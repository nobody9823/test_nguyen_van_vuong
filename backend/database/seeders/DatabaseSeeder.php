<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // $this->call(UserSeeder::class);
        // $this->call(AdminSeeder::class);
        // $this->call(CompanySeeder::class);
        //$this->call(TalentSeeder::class);
        // $this->call(TemporaryTalentSeeder::class);
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('projects')->truncate();
        // $this->call(ProjectSeeder::class);
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // $this->call(CategorySeeder::class);
        // $this->call(FundingModelSeeder::class);
        // $this->call(TemporaryCompanySeeder::class);

        // \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
