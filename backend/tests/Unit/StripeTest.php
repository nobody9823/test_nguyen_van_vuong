<?php

namespace Tests\Unit;

use Tests\TestCase;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class StripeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = new User();
    }

    public function testSuccessPayment()
    {
        $stripe_client = new \Stripe\StripeClient(config('app.stripe_secret'));
        $params = [
            'type' => 'card',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => '12',
                'exp_year' => '2024',
                'cvc' => '314',
            ]
        ];
        $payment_method = $stripe_client->paymentMethods->create($params);
        $response = $this->user->charge(1000, $payment_method->id);
        $this->assertSame(true, is_string($response->id));
    }

    public function testFailByCardDeclined()
    {
        $this->expectException(Exception::class);

        $stripe_client = new \Stripe\StripeClient(config('app.stripe_secret'));

        $params = [
            'type' => 'card',
            'card' => [
                'number' => '4000000000000341',
                'exp_month' => '12',
                'exp_year' => '2024',
                'cvc' => '314',
            ]
        ];
        $payment_methods = $stripe_client->paymentMethods->create($params);
        ($this->user->charge(1000, $payment_methods->id))->execute(1);
    }

    public function testFailByExpiredCard()
    {
        $this->expectException(Exception::class);
        $stripe_client = new \Stripe\StripeClient(config('app.stripe_secret'));

        $params = [
            'type' => 'card',
            'card' => [
                'number' => '4000000000000069',
                'exp_month' => '12',
                'exp_year' => '2024',
                'cvc' => '314',
            ]
        ];
        $payment_method = $stripe_client->paymentMethods->create($params);
        ($this->user->charge(1000, $payment_method->id))->execute(1);
    }

    public function testFailByCardDeclinedByInvalidExpirationDate()
    {
        $this->expectException(Exception::class);
        $stripe_client = new \Stripe\StripeClient(config('app.stripe_secret'));

        $params = [
            'type' => 'card',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => '12',
                'exp_year' => '2000',
                'cvc' => '314',
            ]
        ];
        $payment_method = $stripe_client->paymentMethods->create($params);
        ($this->user->charge(1000, $payment_method->id))->execute(1);
    }
}
