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
    public function Payment(int $price, string $pay_jp_id): object
    {
        \Payjp\Payjp::setApiKey(config('app.pay_jp_secret_for_test'));
        try {
            $result = \Payjp\Charge::create(array(
                        "card" => $pay_jp_id,
                        "amount" => $price,
                        "currency" => "jpy",
                ));
            } catch(\Payjp\Error\Card $e) {
                throw $e;
            } catch (\Payjp\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Payjp's API
                throw $e;
            } catch (\Payjp\Error\Authentication $e) {
                // Authentication with Payjp's API failed
                throw $e;
            } catch (\Payjp\Error\ApiConnection $e) {
                // Network communication with Payjp failed
                throw $e;
            } catch (\Payjp\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                throw $e;
            } catch(\Exception $e){
            // Something else happened, completely unrelated to Payjp
            throw $e;
            }
        return $result;
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
