<?php

namespace Tests\Unit;

use Tests\TestCase;
use Exception;
use App\Actions\PayJp\PayJp;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayJpTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->pay_jp = new PayJp();
    }

    public function testSuccessPayment()
    {
        \Payjp\Payjp::setApiKey(config('app.pay_jp_secret'));

        $params = [
            'card' => [
                "number" => "4242424242424242",
                "exp_month" => "12",
                "exp_year" => "2024",
            ]
        ];
        $token = \Payjp\Token::create($params, $options = ['payjp_direct_token_generate' => 'true']);
        $response = $this->pay_jp->Payment(1000, $token->id);
        $this->assertSame(true, is_string($response->id));
    }

    public function testFailByCardDeclined()
    {
        $this->expectException(Exception::class);
        \Payjp\Payjp::setApiKey(config('app.pay_jp_secret'));

        $params = [
            'card' => [
                "number" => "4000000000080319",
                "exp_month" => "12",
                "exp_year" => "2024",
            ]
        ];
        $token = \Payjp\Token::create($params, $options = ['payjp_direct_token_generate' => 'true']);
        ($this->pay_jp->Payment(1000, $token->id))->execute(1);
    }

    public function testFailByExpiredCard()
    {
        $this->expectException(Exception::class);
        \Payjp\Payjp::setApiKey(config('app.pay_jp_secret'));

        $params = [
            'card' => [
                "number" => "4000000000004012",
                "exp_month" => "12",
                "exp_year" => "2024",
            ]
        ];
        $token = \Payjp\Token::create($params, $options = ['payjp_direct_token_generate' => 'true']);
        ($this->pay_jp->Payment(1000, $token->id))->execute(1);
    }

    public function testFailByCardDeclinedByInvalidExpirationDate()
    {
        $this->expectException(Exception::class);
        \Payjp\Payjp::setApiKey(config('app.pay_jp_secret'));

        $params = [
            'card' => [
                "number" => "4000000000000077",
                "exp_month" => "12",
                "exp_year" => "2024",
            ]
        ];
        $token = \Payjp\Token::create($params, $options = ['payjp_direct_token_generate' => 'true']);
        ($this->pay_jp->Payment(1000, $token->id))->execute(1);
    }
}
