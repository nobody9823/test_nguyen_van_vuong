<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserDetail;
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
        $user = User::factory()->valleyin()->create();
        $user->userAddresses()->saveMany(UserAddress::factory(random_int(1, 3))->make());
        $user->userDetail()->save(UserDetail::factory()->make());
        User::factory(100)->create()
            ->each(function ($user) {
                $user->userAddresses()->saveMany(UserAddress::factory(random_int(1, 3))->make());
                $user->userDetail()->save(UserDetail::factory()->make());
            });
    }
}
