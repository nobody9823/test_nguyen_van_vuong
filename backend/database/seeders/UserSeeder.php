<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use App\Models\Identification;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\SnsLink;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->valleyin()->create()->each(function ($user) {
            $user->address()->save(Address::factory()->make());
            $user->identification()->save(Identification::factory()->make());
            $user->profile()->save(Profile::factory()->make());
            $user->snsLink()->save(SnsLink::factory()->make());
        });

        User::factory(100)->create()->each(function ($user) {
            $user->address()->save(Address::factory()->make());
            $user->identification()->save(Identification::factory()->make());
            $user->profile()->save(Profile::factory()->make());
        });
    }
}
