<?php

namespace Database\Factories;

use App\Enums\PaymentJobCd;
use App\Models\PaymentToken;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Traits\UniqueToken;

class PaymentTokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentToken::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'payment_id' => random_int(1, 100),
            'order_id' => UniqueToken::getToken(),
            'access_id' => UniqueToken::getToken(),
            'access_pass' => UniqueToken::getToken(),
            'job_cd' => PaymentJobCd::getValues()[random_int(0, 2)],
        ];
    }
}
