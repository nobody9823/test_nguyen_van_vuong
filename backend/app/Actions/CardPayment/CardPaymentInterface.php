<?php

namespace App\Actions\CardPayment;

interface CardPaymentInterface
{
    /**
     * Return result of entryTran by GMO
     *
     * @param int
     * @param string
     *
     * @return object
     */
    public function entryTran(int $price, string $order_id): object;

    /**
     * Return result of execTran by GMO
     *
     * @param string
     * @param string
     * @param string
     * @param string
     *
     * @return object
     */
    public function execTran(string $payment_method_id, string $access_id, string $access_pass, string $order_id): object;

    /**
     * Return result of refund by GMO
     *
     * @param string
     * @param string
     * @param int
     *
     * @return object
     */
    public function refund(string $access_id, string $access_pass, int $price): object;

    /**
     * Return result of alter sales by GMO
     *
     * @param string
     * @param string
     * @param int
     *
     * @return object
     */
    public function alterSales(string $access_id, string $access_pass, int $price): object;

    /**
     * Return result of search trade by GMO
     *
     * @param string
     *
     * @return object
     */
    public function searchTrade(string $order_id): object;

    /**
     * Return result of entryTran convenience by GMO
     *
     * @param int
     * @param string
     *
     * @return array
     */
    public function entryTranCVS(int $price, string $order_id): array;

    /**
     * Return result of execTran convenience by GMO
     *
     * @param string
     * @param string
     * @param string
     * @param string
     * @param object
     * @param int
     *
     * @return array
     */
    public function execTranCVS(string $cvs_code, string $access_id, string $access_pass, string $order_id, object $user, int $cvs_term_day): array;

    /**
     * Return result of refund convenience by GMO
     *
     * @param string
     * @param string
     * @param string
     *
     * @return array
     */
    public function refundCVS(string $access_id, string $access_pass, string $order_id): array;

    /**
     * Return result of search multiPay trade by GMO
     *
     * @param string
     * @param int
     *
     * @return array
     */
    public function searchTradeMulti(string $order_id, int $pay_type): array;

    /**
     * Get bank account as 'GMO'
     *
     * @return string
     */
    public function getPaymentApiName(): string;

    /**
     * Get bank account as 'GMO'
     *
     * @param string
     *
     * @return object
     */
    public function getBankAccount(string $bank_id): object;

    /**
     * Register bank account as 'GMO'
     *
     * @param int
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
        int $method,
        string $bank_id,
        string $bank_code,
        string $branch_code,
        string $account_type,
        string $account_number,
        string $account_name
    ): object;

    /**
     * remittance deposit as 'GMO'
     *
     * @param string
     * @param string
     * @param int
     * @param int
     *
     * @return object
     */
    public function remittance(string $deposit_id, string $bank_id, int $amount, int $method): object;

    /**
     * search deposit as 'GMO'
     *
     * @param string
     *
     * @return object
     */
    public function searchRemittance(string $deposit_id): object;

    /**
     * mail remittance deposit as 'GMO'
     *
     * @param string
     * @param string
     * @param int
     * @param int
     * @param object
     *
     * @return object
     */
    public function mailRemittance(string $deposit_id, int $amount, int $method, object $user): object;

    /**
     * mail search deposit as 'GMO'
     *
     * @param string
     *
     * @return object
     */
    public function mailSearchRemittance(string $deposit_id): object;
}
