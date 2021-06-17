<?php

namespace Database\Factories;

use App\Models\TemporaryCompany;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class TemporaryCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TemporaryCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker_en = FakerFactory::create('en_US');
        return [
            'name' => $this->faker->word . '会社',
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'office_address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'certificate_file_1' => 'public/sampleImage/companySample.jpg',
            'certificate_file_2' => 'public/sampleImage/companySample.jpg',
            'certificate_file_3' => 'public/sampleImage/companySample.jpg',
            'recognition_of_service' => $this->faker->title,
            'bank_name' => $this->faker->lastName.'銀行',
            'bank_branch_name' => $this->faker->lastName.'支店',
            'bank_account_number' => $this->faker->bankAccountNumber,
            'bank_account_holder' => Str::of($this->faker_en->name)->upper(),
        ];
    }
}
