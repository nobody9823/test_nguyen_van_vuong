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

        User::factory(100)->create()->each(function(User $user){
            $user->userAddresses()->saveMany(UserAddress::factory(random_int(1, 3))->make());
        });
    }
}
