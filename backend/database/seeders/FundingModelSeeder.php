<?php

namespace Database\Seeders;

use App\Models\FundingModel;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class FundingModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FundingModel::truncate();
        $now = Carbon::now();
        DB::table('funding_models')->insert([
            ['name' => 'All or Nothing', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'All In', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
