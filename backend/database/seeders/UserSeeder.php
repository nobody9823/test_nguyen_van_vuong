<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use App\Models\BankAccount;
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
            $user->address()->save(Address::factory()->make());
            $user->bankAccount()->save(BankAccount::factory()->make());
        });
    }
}
