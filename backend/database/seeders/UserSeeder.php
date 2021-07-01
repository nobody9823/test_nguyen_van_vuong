<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use App\Models\BankAccount;
use App\Models\Payment;
use App\Models\Profile;
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
        User::factory()->valleyin()->create()->each(function(User $user){
            $user->address()->save(Address::factory()->make());
            $user->bankAccount()->save(BankAccount::factory()->make());
            $user->profile()->save(Profile::factory()->make());
            $user->payments()->saveMany(Payment::factory(3)->make());
        });;

        User::factory(100)->create()->each(function(User $user){
            $user->address()->save(Address::factory()->make());
            $user->bankAccount()->save(BankAccount::factory()->make());
            $user->profile()->save(Profile::factory()->make());
            $user->payments()->saveMany(Payment::factory(3)->make());
        });
    }
}
