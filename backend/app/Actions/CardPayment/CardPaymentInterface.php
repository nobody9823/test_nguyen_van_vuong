<?php

namespace App\Actions\CardPayment;

interface CardPaymentInterface
{
    /**
     * Return result of payment by Stripe
     *
     * @param int
     * @param string
     * @param string
     *
     * @return object
     */
    public function charge(int $price, string $payment_method_id, string $connected_account_id): object;

    /**
     * Refund already finished payment
     *
     * @param string
     *
     * @return object
     */
    public function refund(string $payment_id): object;

    /**
     * Create connected account
     *
     * @param int
     * @param string
     * @return object
     */
    public function createConnectedAccount(int $user_id, string $ip): object;

    /**
     * Update external account
     *
     * @param int
     * @param string
     * @return object
     */
    public function updateExternalAccount(int $user_id, string $bank_token): object;

    /**
     * Create identity document file
     *
     * @param int
     * @return object
     */
    public function createIdentityDocument(int $user_id): object;

    /**
     * Attach identity document to connected account
     *
     * @param int
     * @param string
     * @return object
     */
    public function attachIdentityDocument(int $user_id, string $file_id): object;

    /**
     * Get payment api name
     *
     * @return string
     */
    public function getPaymentApiName(): string;
}
