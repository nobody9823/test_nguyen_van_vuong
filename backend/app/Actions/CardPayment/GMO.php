<?php

namespace App\Actions\CardPayment;

use App\Actions\CardPayment\CardPaymentInterface;
use Exception;
use Illuminate\Support\Facades\Http;
use Log;

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
        try {
            $entry_response = Http::retry(5, 100)->post(config('app.gmo_entry_payment_url'), [
                'shopID' => config('app.gmo_shop_id'),
                'shopPass' => config('app.gmo_shop_pass'),
                'orderID' => $order_id,
                'jobCd' => 'AUTH',
                'amount' => $price,
            ]);
            return $entry_response;
        } catch (Exception $e) {
            Log::alert($e->getMessage());
            return response('決済処理に失敗しました。もう一度カード番号の入力とリターンを選択してください。', 400);
        }
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
        try {
            $exec_response = Http::retry(5, 100)->post(config('app.gmo_exec_payment_url'), [
                'accessID' => $access_id,
                'accessPass' => $access_pass,
                'orderID' => $order_id,
                'method' => '1',
                'token' => $payment_method_id,
            ]);
            return $exec_response;
        } catch (Exception $e) {
            Log::alert($e->getMessage());
            return response('決済処理に失敗しました。もう一度カード番号の入力とリターンを選択してください。', 400);
        }
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
        try {
            $response = Http::retry(5, 100)->post(config('app.gmo_alter_payment_url'), [
                'shopID' => config('app.gmo_shop_id'),
                'shopPass' => config('app.gmo_shop_pass'),
                'accessID' => $access_id,
                'accessPass' => $access_pass,
                'jobCd' => 'CANCEL',
                'amount' => $price,
            ]);

            return $response;
        } catch (Exception $e) {
            Log::alert($e->getMessage());
            return response('決済処理の取り消しに失敗しました。', 400);
        }
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
        try {
            $response = Http::retry(5, 100)->post(config('app.gmo_search_payment_url'), [
                'shopID' => config('app.gmo_shop_id'),
                'shopPass' => config('app.gmo_shop_pass'),
                'orderID' => $order_id,
            ]);
            return $response;
        } catch (Exception $e) {
            Log::alert($e->getMessage());
            return response('決済検索に失敗しました。', 400);
        }
    }

    /**
     * Return result of entryTran convenience by GMO
     *
     * @param int
     * @param string
     *
     * @return array
     */
    public function entryTranCVS(int $price, string $order_id): array
    {
        $entry_response = Http::retry(5, 100)->asForm()->post(config('app.gmo_cvs_entry_payment_url'), [
            'ShopID' => config('app.gmo_shop_id'),
            'ShopPass' => config('app.gmo_shop_pass'),
            'OrderID' => $order_id,
            'Amount' => $price,
        ]);

        $processed_entry_response = collect(explode('&', $entry_response->body()))->mapWithKeys(function ($arr) {
            $devided_arr = explode('=', $arr);
            return [$devided_arr[0] => $devided_arr[1]];
        })->toArray();

        if (\Illuminate\Support\Arr::has($processed_entry_response, 'ErrCode')) {
            Log::alert('コンビニ決済登録に失敗', $processed_entry_response);
        }

        return $processed_entry_response;
    }

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
    public function execTranCVS(string $cvs_code, string $access_id, string $access_pass, string $order_id, object $user, int $cvs_term_day): array
    {
        $exec_response = Http::retry(5, 100)->asForm()->post(config('app.gmo_cvs_exec_payment_url'), [
            'AccessID' => $access_id,
            'AccessPass' => $access_pass,
            'OrderID' => $order_id,
            'Convenience' => $cvs_code,
            'CustomerName' => mb_convert_encoding($user->profile->last_name . $user->profile->first_name, "SJIS"),
            'CustomerKana' => mb_convert_encoding($user->profile->last_name_kana . $user->profile->first_name_kana, "SJIS"),
            'TelNo' => $user->profile->phone_number,
            'PaymentTermDay' => $cvs_term_day,
            'MailAddress' => $user->email,
            'RegisterDisp1' => mb_convert_encoding('ファンリターン', "SJIS"),
            'ReceiptsDisp1' => mb_convert_encoding('ご利用ありがとうございました。', "SJIS"),
            'ReceiptsDisp11' => mb_convert_encoding('株式会社ICH', "SJIS"),
            'ReceiptsDisp12' => '03-3780-7194',
            'ReceiptsDisp13' => '09:00-18:00',
        ]);
        $processed_exec_response = collect(explode('&', $exec_response->body()))->mapWithKeys(function ($arr) {
            $devided_arr = explode('=', $arr);
            return [$devided_arr[0] => $devided_arr[1]];
        })->toArray();

        if (\Illuminate\Support\Arr::has($processed_exec_response, 'ErrCode')) {
            Log::alert('コンビニ決済実行に失敗', $processed_exec_response);
        }

        return $processed_exec_response;
    }

    /**
     * Return result of refund convenience by GMO
     *
     * @param string
     * @param string
     * @param string
     *
     * @return array
     */
    public function refundCVS(string $access_id, string $access_pass, string $order_id): array
    {
        $refund_response = Http::retry(5, 100)->asForm()->post(config('app.gmo_cvs_refund_payment_url'), [
            'ShopID' => config('app.gmo_shop_id'),
            'ShopPass' => config('app.gmo_shop_pass'),
            'AccessID' => $access_id,
            'AccessPass' => $access_pass,
            'OrderID' => $order_id,
        ]);

        $processed_refund_response = collect(explode('&', $refund_response->body()))->mapWithKeys(function ($arr) {
            $devided_arr = explode('=', $arr);
            return [$devided_arr[0] => $devided_arr[1]];
        })->toArray();

        if (\Illuminate\Support\Arr::has($processed_refund_response, 'ErrCode')) {
            Log::alert('コンビニ決済支払い停止に失敗', $processed_refund_response);
        }

        return $processed_refund_response;
    }

    /**
     * Return result of search multiPay trade by GMO
     *
     * @param string
     * @param int
     *
     * @return array
     */
    public function searchTradeMulti(string $order_id, int $pay_type): array
    {
        $search_response = Http::retry(5, 100)->asForm()->post(config('app.gmo_multi_search_payment_url'), [
            'ShopID' => config('app.gmo_shop_id'),
            'ShopPass' => config('app.gmo_shop_pass'),
            'OrderID' => $order_id,
            'PayType' => $pay_type,
        ]);

        $processed_search_response = collect(explode('&', $search_response->body()))->mapWithKeys(function ($arr) {
            $devided_arr = explode('=', $arr);
            return [$devided_arr[0] => $devided_arr[1]];
        })->toArray();

        if (\Illuminate\Support\Arr::has($processed_search_response, 'ErrCode')) {
            Log::alert('マルチペイメント決済検索に失敗', $processed_search_response);
        }

        return $processed_search_response;
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
        $response = Http::retry(5, 100)->post(config('app.gmo_bank_account_search_url'), [
            'Shop_ID' => config('app.gmo_pg_shop_id'),
            'Shop_Pass' => config('app.gmo_pg_shop_pass'),
            'Bank_ID' => $bank_id,
        ]);

        if (!\Illuminate\Support\Arr::has($response->json(), 'Bank_ID')) {
            Log::alert($response->body());
            throw new Exception($response->body());
        }

        return $response;
    }

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
    ): object {
        $response = Http::retry(5, 100)->post(config('app.gmo_bank_account_url'), [
            'Shop_ID' => config('app.gmo_pg_shop_id'),
            'Shop_Pass' => config('app.gmo_pg_shop_pass'),
            'Method' => $method,
            'Bank_ID' => $bank_id,
            'Bank_Code' => $bank_code,
            'Branch_Code' => $branch_code,
            'Account_Type' => $account_type,
            'Account_Number' => $account_number,
            'Account_Name' => $account_name,
        ]);

        return $response;
    }

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
    public function remittance(string $deposit_id, string $bank_id, int $amount, int $method): object
    {
        $response = Http::retry(5, 100)->post(config('app.gmo_remittance_deposit_url'), [
            'Shop_ID' => config('app.gmo_pg_shop_id'),
            'Shop_Pass' => config('app.gmo_pg_shop_pass'),
            'Method' => $method,
            'Deposit_ID' => $deposit_id,
            'Bank_ID' => $bank_id,
            'Amount' => $amount,
        ]);

        if (!\Illuminate\Support\Arr::has($response->json(), 'Deposit_ID')) {
            Log::alert($response->body());
            throw new Exception($response->body());
        }

        return $response;
    }

    /**
     * search deposit as 'GMO'
     *
     * @param string
     *
     * @return object
     */
    public function searchRemittance(string $deposit_id): object
    {
        $response = Http::retry(5, 100)->post(config('app.gmo_search_remittance_url'), [
            'Shop_ID' => config('app.gmo_pg_shop_id'),
            'Shop_Pass' => config('app.gmo_pg_shop_pass'),
            'Deposit_ID' => $deposit_id,
        ]);

        if (!\Illuminate\Support\Arr::has($response->json(), 'Deposit_ID')) {
            Log::alert($response->body());
            throw new Exception($response->body());
        }

        return $response;
    }

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
    public function mailRemittance(string $deposit_id, int $amount, int $method, object $user): object
    {
        $response = Http::retry(5, 100)->post(config('app.gmo_mail_remittance_deposit_url'), [
            'Shop_ID' => config('app.gmo_pg_shop_id'),
            'Shop_Pass' => config('app.gmo_pg_shop_pass'),
            'Method' => $method,
            'Deposit_ID' => $deposit_id,
            'Amount' => $amount,
            'Mail_Address' => $user->email,
            'Expire' => 30,
            'Auth_Code' => $user->profile->phone_number,
            'Mail_Template_Number' => 1,
            'Remit_Method_Bank' => 1,
            'Remit_Method_Sevenatm' => 0,
            'Remit_Method_Amazongift' => 0,
        ]);

        if (!\Illuminate\Support\Arr::has($response->json(), 'Deposit_ID')) {
            Log::alert($response->body());
            throw new Exception($response->body());
        }

        return $response;
    }

    /**
     * mail search deposit as 'GMO'
     *
     * @param string
     *
     * @return object
     */
    public function mailSearchRemittance(string $deposit_id): object
    {
        $response = Http::retry(5, 100)->post(config('app.gmo_mail_search_remittance_url'), [
            'Shop_ID' => config('app.gmo_pg_shop_id'),
            'Shop_Pass' => config('app.gmo_pg_shop_pass'),
            'Deposit_ID' => $deposit_id,
        ]);

        if (!\Illuminate\Support\Arr::has($response->json(), 'Deposit_ID')) {
            Log::alert($response->body());
            throw new Exception($response->body());
        }

        return $response;
    }
}
