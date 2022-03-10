<?php

namespace App\Http\Controllers\User;

use App\Actions\CardPayment\CardPaymentInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Services\Project\RemittanceService;

class SupporterController extends Controller
{
    public function __construct(CardPaymentInterface $card_payment_interface, RemittanceService $remittance)
    {
        $this->card_payment = $card_payment_interface;
        $this->remittance = $remittance;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $this->authorize('checkOwnProject', $project);
        $project->load(['payments', 'payments.user', 'payments.includedPlans', 'payments.user.address']);
        $project->payments->map(function ($payment) {
            if ($payment->payment_api === 'GMO') {
                if ($payment->payment_way === 'credit') {
                    $response = $this->card_payment->searchTrade($payment->paymentToken->order_id);
                    if ($response->status() === 200) {
                        $payment->setAttribute('gmo_job_cd', $response['jobCd']);
                    } else {
                        $payment->setAttribute('gmo_job_cd', 'FAILED');
                    }
                } else if ($payment->payment_way === 'cvs') {
                    $response = $this->card_payment->searchTradeMulti($payment->paymentToken->order_id, 3);
                    if (!\Arr::has($response, 'ErrCode') && \Arr::has($response, 'Status')) {
                        $payment->setAttribute('gmo_job_cd', $response['Status']);
                        $payment->setAttribute('convenience', $response['CvsCode']);
                        $payment->setAttribute('conf_no', $response['CvsConfNo']);
                        $payment->setAttribute('receipt_no', $response['CvsReceiptNo']);
                    } else {
                        $payment->setAttribute('gmo_job_cd', 'DEFAULT');
                    }
                }
            } else {
                $payment->setAttribute('gmo_job_cd', 'DEFAULT');
            }
        });
        return view('user.supporter.index', ['project' => $project]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
