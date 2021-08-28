<?php

namespace App\Actions\CardPayment;

interface CardPaymentInterface
{
    /**
     * Return result of charge by card payment
     *
     * @param int
     * @param string
     *
     * @return object
     */
    public function charge(int $price, string $payment_method_id): object;

    /**
     * Refund already finished payment
     *
     * @param string
     *
     * @return object
     */
    public function refund(string $payment_id): object;

    /**
     * Get payment api name
     *
     * @return string
     */
    public function getPaymentApiName(): string;
}
