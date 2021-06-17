<?php

namespace Database\Factories;

use App\Models\TemporaryTalent;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TemporaryTalentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TemporaryTalent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker_en = FakerFactory::create('en_US');
        //今のところ登録メールアドレスを名前に入れておく仕様なのでnameもemailも同じ$emailで
        $email = $this->faker->unique()->safeEmail;
        return [
            'company_id' => 1,
            'name' => $email,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
            'office_address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'certificate_file_1' => 'public/sampleImage/talentSample.jpg',
            'certificate_file_2' => 'public/sampleImage/talentSample.jpg',
            'certificate_file_3' => 'public/sampleImage/talentSample.jpg',
            'recognition_of_service' => $this->faker->title,
            'bank_name' => $this->faker->lastName.'銀行',
            'bank_branch_name' => $this->faker->lastName.'支店',
            'bank_account_number' => $this->faker->bankAccountNumber,
            'bank_account_holder' => Str::of($this->faker_en->name)->upper(),
        ];
    }
}
