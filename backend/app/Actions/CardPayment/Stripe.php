<?php

namespace App\Actions\CardPayment;

use App\Actions\CardPayment\CardPaymentInterface;
use App\Models\User;

class Stripe implements CardPaymentInterface
{
    /**
     * Return result of payment by Stripe
     *
     * @param int
     * @param string
     *
     * @return object
     */
    public function charge(int $price, string $payment_method_id): object
    {
        try {
            $result = (new User)->charge($price, $payment_method_id);
        } catch (\Stripe\Exception\CardException $e) {
            // Since it's a decline, \Stripe\Exception\CardException will be caught
            // echo 'Status is:' . $e->getHttpStatus() . '\n';
            // echo 'Type is:' . $e->getError()->type . '\n';
            // echo 'Code is:' . $e->getError()->code . '\n';
            // param is '' in this case
            // echo 'Param is:' . $e->getError()->param . '\n';
            // echo 'Message is:' . $e->getError()->message . '\n';
            throw $e;
        } catch (\Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            throw $e;
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            throw $e;
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            throw $e;
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            throw $e;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            throw $e;
        } catch (\Exception $e) {
            // Something else happened, completely unrelated to Stripe
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
        return (new User)->refund($payment_id);
    }

    /**
     * Get payment api name as 'Stripe'
     *
     * @return string
     */
    public function getPaymentApiName(): string
    {
        return 'Stripe';
    }
}
