<?php

namespace App\Actions\CardPayment;

use App\Actions\CardPayment\CardPaymentInterface;
use Illuminate\Http\Request;

class PayJp implements CardPaymentInterface
{
    /**
     * Return result of payment by Pay jp
     *
     * @param int
     * @param \Illuminate\Http\Request
     *
     * @return object
     */
    public function charge(int $price, string $payment_method_id): object
    {
        \Payjp\Payjp::setApiKey(config('app.pay_jp_secret'));
        try {
            $result = \Payjp\Charge::create(array(
                "card" => $payment_method_id,
                "amount" => $price,
                "currency" => "jpy",
            ));
        } catch (\Payjp\Error\Card $e) {
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
        } catch (\Exception $e) {
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
    public function refund(string $payment_id): object
    {
        \Payjp\Payjp::setApiKey(config('app.pay_jp_secret'));
        $charge = \Payjp\Charge::retrieve($payment_id);
        return $charge->refund();
    }

    /**
     * Get payment api name as 'PayJp'
     *
     * @return string
     */
    public function getPaymentApiName(): string
    {
        return 'PayJp';
    }
}
