<?php

namespace App\Actions\GMO;

use App\Actions\CardPayment\GMO;
use App\Models\Payment;

class UpdatePaymentIsFinishedByCVS
{
    public function __construct()
    {
        $this->cvs_payments = Payment::where('payment_way', 'GMO')->where('payment_way', 'cvs')->get();
        $this->card_payment = new GMO;
    }

    public function __invoke()
    {
        $this->cvs_payments->map(function ($payment) {
            $response = $this->card_payment->searchTradeMulti($payment->paymentToken->order_id, 3);
            if (!\Arr::has($response, 'ErrCode')) {
                $payment->setAttribute('gmo_job_cd', $response['Status']);
            } else {
                $payment->setAttribute('gmo_job_cd', 'DEFAULT');
            }
        });
        foreach ($this->cvs_payments as $payment) {
            if ($payment->gmo_job_cd === 'EXPIRED') {
                $payment->offsetUnset('gmo_job_cd');
                $payment->update(['payment_is_finished' => false]);
            }
        }
    }
}
