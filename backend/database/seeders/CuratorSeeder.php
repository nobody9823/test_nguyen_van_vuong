<?php

namespace Database\Seeders;

use App\Models\Curator;
use Illuminate\Database\Seeder;

class CuratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curator::factory()->valleyin()->create();

        Curator::factory(10)->create();
    }
}
