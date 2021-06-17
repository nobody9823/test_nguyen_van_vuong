<?php

namespace App\Actions\PayJp;

use App\Actions\PayJp\PayJpInterface;
use Illuminate\Http\Request;
class PayJp implements PayJpInterface
{
    /**
     * Return result of payment by Pay jp
     *
     * @param int
     * @param \Illuminate\Http\Request
     *
     * @return object
     */
    public function Payment(int $price, Request $request): object
    {
        $request->validate([
            'payjp-token' => 'required'
        ]);

        \Payjp\Payjp::setApiKey(config('app.pay_jp_secret_for_test'));
        return \Payjp\Charge::create(array(
                "card" => $request['payjp-token'],
                "amount" => $price,
                "currency" => "jpy",
            ));
    }

    /**
     * Refund already finished payment
     *
     * @param string
     *
     * @return object
     */
    public function Refund(string $pay_jp_id): object
    {
        \Payjp\Payjp::setApiKey(config('app.pay_jp_secret_for_test'));
        $charge = \Payjp\Charge::retrieve($pay_jp_id);
        return $charge->refund();
    }
}
