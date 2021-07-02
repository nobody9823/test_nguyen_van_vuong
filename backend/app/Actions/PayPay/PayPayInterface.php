<?php
namespace App\Actions\PayPay;

use App\Models\Project;

use App\Models\Payment;

interface PayPayInterface
{
    public function createQrCode(string $merchant_payment_id, int $price, Project $project, Payment $payment): array;

    public function getPaymentDetail(string $merchant_payment_id): array;

    public function cancelPayment(string $merchant_payment_id): array;

    public function deleteQRCode(string $merchant_payment_id): array;
}