<?php

namespace App\Actions\PayPay;

use App\Models\Payment;
use App\Models\Project;
use PayPay\OpenPaymentAPI\Client;
use PayPay\OpenPaymentAPI\Models\CreateQrCodePayload;
use PayPay\OpenPaymentAPI\Models\OrderItem;
use App\Models\UserAddress;
use Exception;
use Illuminate\Http\Request;
use Log;

class PayPay implements PayPayInterface
{
    protected $client;

    protected $CQCPayload;

    public function __construct(CreateQrCodePayload $CQCPayload)
    {
        $this->client = new Client([
            'API_KEY' => config('app.pay_pay_key_for_test'),
            'API_SECRET' => config('app.pay_pay_secret_for_test'),
            'MERCHANT_ID' => config('app.merchant_id'),
        ], config('app.sandbox'));

        $this->CQCPayload = $CQCPayload;
    }

    // QRコードを生成する関数
    public function createQrCode(string $merchant_payment_id, int $price, Project $project, Payment $payment): array
    {
        try {
            // 任意の支払い取引IDを生成(64桁以内)
            $this->CQCPayload->setMerchantPaymentId($merchant_payment_id);
            $this->CQCPayload->setRequestedAt();
            $this->CQCPayload->setCodeType("ORDER_QR");

            $this->CQCPayload->setAmount([
                'amount' => $price,
                "currency" => "JPY"
            ]);

            // 支払いがウェブブラウザで発生している場合は WEB_LINK になります。
            $this->CQCPayload->setRedirectType('WEB_LINK');
            // 支払い後のリダイレクト先
            $this->CQCPayload->setRedirectUrl(route('user.plan.payment_for_pay_pay', ['project' => $project, 'payment_without_globalscope' => $payment]));

            // QRコードを生成
            return $this->client->code->createQRCode($this->CQCPayload);
        } catch (Exception $e) {
            Log::alert($e->getMessage(), $e->getTrace());
            throw $e;
        }
    }

    public function getPaymentDetail(string $merchant_payment_id): array
    {
        // 作成済みのQRコードのデータを取得
        return $this->client->code->getPaymentDetails($merchant_payment_id);
    }

    public function cancelPayment(string $merchant_payment_id): array
    {
        return $this->client->payment->cancelPayment($merchant_payment_id);
    }

    public function deleteQRCode(string $codeId): array
    {
        // QRコードの削除
        return $this->client->code->deleteQRCode($codeId);
    }
}
