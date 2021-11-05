<?php

namespace App\Actions\CardPayment;

use App\Actions\CardPayment\CardPaymentInterface;
use Illuminate\Support\Facades\Http;

class GMO implements CardPaymentInterface
{
    /**
     * Return result of entryTran by GMO
     *
     * @param int
     * @param string
     *
     * @return object
     */
    public function entryTran(int $price, string $order_id): object
    {
        $entry_response = Http::retry(5, 100)->post(config('app.gmo_entry_payment_url'), [
            'shopID' => config('app.gmo_shop_id'),
            'shopPass' => config('app.gmo_shop_pass'),
            'orderID' => $order_id,
            'jobCd' => 'AUTH',
            'amount' => $price,
        ]);

        return $entry_response;
    }

    /**
     * Return result of execTran by GMO
     *
     * @param string
     *
     * @return object
     */
    public function execTran(string $payment_method_id, string $access_id, string $access_pass, string $order_id): object
    {
        $exec_response = Http::retry(5, 100)->post(config('app.gmo_exec_payment_url'), [
            'accessID' => $access_id,
            'accessPass' => $access_pass,
            'orderID' => $order_id,
            'method' => '1',
            'token' => $payment_method_id,
        ]);

        return $exec_response;
    }

    /**
     * Return result of refund by GMO
     *
     * @param string
     * @param string
     * @param int
     *
     * @return object
     */
    public function refund(string $access_id, string $access_pass, int $price): object
    {
        $response = Http::retry(5, 100)->post(config('app.gmo_alter_payment_url'), [
            'shopID' => config('app.gmo_shop_id'),
            'shopPass' => config('app.gmo_shop_pass'),
            'accessID' => $access_id,
            'accessPass' => $access_pass,
            'jobCd' => 'CANCEL',
            'amount' => $price,
        ]);

        return $response;
    }

    /**
     * Return result of alter sales by GMO
     *
     * @param string
     * @param string
     * @param int
     *
     * @return object
     */
    public function alterSales(string $access_id, string $access_pass, int $price): object
    {
        $response = Http::retry(5, 100)->post(config('app.gmo_alter_payment_url'), [
            'shopID' => config('app.gmo_shop_id'),
            'shopPass' => config('app.gmo_shop_pass'),
            'accessID' => $access_id,
            'accessPass' => $access_pass,
            'jobCd' => 'SALES',
            'amount' => $price,
        ]);

        return $response;
    }

    /**
     * Return result of search trade by GMO
     *
     * @param string
     *
     * @return object
     */
    public function searchTrade(string $order_id): object
    {
        $response = Http::retry(5, 100)->post(config('app.gmo_search_payment_url'), [
            'shopID' => config('app.gmo_shop_id'),
            'shopPass' => config('app.gmo_shop_pass'),
            'orderID' => $order_id,
        ]);

        return $response;
    }

    /**
     * Get payment api name as 'GMO'
     *
     * @return string
     */
    public function getPaymentApiName(): string
    {
        return 'GMO';
    }

    /**
     * Get bank account as 'GMO'
     *
     * @param string
     *
     * @return object
     */
    public function getBankAccount(string $bank_id): object
    {
        $response = Http::retry(5, 100)->post(config('app.gmo_bank_account_url'), [
            'shopID' => config('app.gmo_shop_id'),
            'shopPass' => config('app.gmo_shop_pass'),
            'bankId' => $bank_id,
        ]);

        return $response;
    }

    /**
     * Register bank account as 'GMO'
     *
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     *
     * @return object
     */
    public function registerBankAccount(
        string $bank_id,
        string $bank_code,
        string $branch_code,
        string $account_type,
        string $account_number,
        string $account_name
    ): object {
        $response = Http::retry(5, 100)->post(config('app.gmo_bank_account_url'), [
            'shopID' => config('app.gmo_shop_id'),
            'shopPass' => config('app.gmo_shop_pass'),
            'method' => '1',
            'bankId' => $bank_id,
            'bankCode' => $bank_code,
            'branchCode' => $branch_code,
            'accountType' => $account_type,
            'accountNumber' => $account_number,
            'accountName' => $account_name,
        ]);

        return $response;
    }

    /**
     * Update bank account as 'GMO'
     *
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     *
     * @return object
     */
    public function updateBankAccount(
        string $bank_id,
        string $bank_code,
        string $branch_code,
        string $account_type,
        string $account_number,
        string $account_name
    ): object {
        $response = Http::retry(5, 100)->post(config('app.gmo_bank_account_url'), [
            'shopID' => config('app.gmo_shop_id'),
            'shopPass' => config('app.gmo_shop_pass'),
            'method' => '2',
            'bankId' => $bank_id,
            'bankCode' => $bank_code,
            'branchCode' => $branch_code,
            'accountType' => $account_type,
            'accountNumber' => $account_number,
            'accountName' => $account_name,
        ]);

        return $response;
    }
}
