<?php

namespace App\Actions\CardPayment;

use App\Actions\CardPayment\CardPaymentInterface;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Stripe implements CardPaymentInterface
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
    public function charge(int $price, string $payment_method_id, string $connected_account_id): object
    {
        try {
            // NOTICE: chargeメソッドの第三引数のオプションで['receipt_email' => Auth::user()->email]を指定すると領収書が送れます。
            // NOTICE: transfer_dataのamountは支払い金額から手数料を引いてインフルエンサーに支払う金額
            $result = (new User)->charge(
                $price,
                $payment_method_id,
                [
                    'transfer_data' => [
                        'destination' => $connected_account_id,
                        'amount' => ceil(bcmul($price, 0.8, 1)),
                    ]
                ]
            );
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
     * Create connected account
     *
     * @param string
     * @return object
     */
    public function createConnectedAccount(string $ip): object
    {
        $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));
        $account = $stripe->accounts->create([
            'type' => 'custom',
            'business_type' => 'individual',
            'business_profile' => [
                'product_description' => 'インターネットを介して支援者から資金を調達し、リターンとして商品やサービスなどを対価として提供する',
                'url' => 'https://fanreturn.com',
                'mcc' => '6012',
            ],
            'capabilities' => [
                'transfers' => ['requested' => true],
            ],
            'tos_acceptance' => [
                'date' => time(),
                'ip' => $ip,
            ],
            'individual' => [
                'email' => Auth::user()->email,
            ]
        ]);
        return $account;
    }

    /**
     * Update personal information
     *
     * @param int
     * @param object
     * @return array
     */
    public function updatePersonalInformation(int $user_id, array $request): object
    {
        $user = User::find($user_id);
        $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));
        try {
            $account = $stripe->accounts->update(
                $user->identification->connected_account_id,
                isset($request['stripe']) ? $request['stripe'] : [],
            );
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            Log::alert($e);
            $account = $stripe->accounts->retrieve($user->identification->connected_account_id);
        } catch (\Exception $e) {
            // Something else happened, completely unrelated to Stripe
            Log::alert($e);
            $account = $stripe->accounts->retrieve($user->identification->connected_account_id);
        }
        return $account;
    }

    /**
     * Update external account
     *
     * @param string
     * @param string
     * @return object
     */
    public function updateExternalAccount(string $connected_account_id, string $bank_token): object
    {
        $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));
        $account = $stripe->accounts->update(
            $connected_account_id,
            [
                'external_account' => $bank_token,
            ]
        );
        return $account;
    }

    /**
     * Create identity document file
     *
     * @param int
     * @return object
     */
    public function createIdentityDocument(int $user_id): object
    {
        $user = User::find($user_id);
        $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));
        $file = $stripe->files->create([
            'purpose' => 'identity_document',
            'file' => Storage::get($user->identification->identify_image_1),
        ]);
        return $file;
    }

    /**
     * Attach identity document to connected account
     *
     * @param string
     * @param string
     * @return object
     */
    public function attachIdentityDocument(string $file_id, string $connected_account_id): object
    {
        $stripe = new \Stripe\StripeClient(config('app.stripe_secret'));
        $account = $stripe->accounts->update(
            $connected_account_id,
            [
                'individual' => [
                    'verification' => [
                        'document' => [
                            'front' => $file_id,
                        ]
                    ]
                ]
            ]
        );
        return $account;
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
