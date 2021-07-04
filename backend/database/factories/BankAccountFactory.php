<?php

namespace Database\Factories;

use App\Enums\BankAccountType;
use App\Models\BankAccount;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class BankAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BankAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker_en = FakerFactory::create('en_US');
        return [
            'bank_code' => str_repeat(random_int(0, 9), 4),
            'branch_code' => str_repeat(random_int(0, 9), 3),
            'account_type' => BankAccountType::getValues()[random_int(0,2)],
            'account_number' => str_repeat(random_int(0, 9), 7),
            'account_name' => Str::of($faker_en->name)->upper(),
        ];
    }
}
