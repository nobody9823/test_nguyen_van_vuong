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
     * @param string
     * @return object
     */
    public function createConnectedAccount(string $ip): object;

    /**
     * Update personal information
     *
     * @param int
     * @param object
     * @return array
     */
    public function updatePersonalInformation(int $user_id, array $request): object;

    /**
     * Update external account
     *
     * @param string
     * @param string
     * @return object
     */
    public function updateExternalAccount(string $connected_account_id, string $bank_token): object;

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
     * @param string
     * @param string
     * @return object
     */
    public function attachIdentityDocument(string $file_id, string $connected_account_id): object;

    /**
     * Get payment api name
     *
     * @return string
     */
    public function getPaymentApiName(): string;
}
