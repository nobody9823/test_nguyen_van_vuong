<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payments = Payment::search()
                    ->NarrowDownByDate()
                    ->NarrowDownByPrice()
                    ->with(['user','inviter','includedPlans.project.user','comment'])
                    ->sortBySelected($request->sort_type);
        //リレーション先OrderBy
        if ($request->sort_type === 'user_name_asc') {
            $payments = $payments->get()->sortBy('user.name')->paginate(10);
        } elseif ($request->sort_type === 'user_name_desc') {
            $payments = $payments->get()->sortByDesc('user.name')->paginate(10);
        } elseif ($request->sort_type === 'inviter_name_asc') {
            $payments = $payments->get()->sortBy('inviter.name')->paginate(10);
        } elseif ($request->sort_type === 'inviter_name_desc') {
            $payments = $payments->get()->sortByDesc('inviter.name')->paginate(10);
        // } elseif ($request->sort_type === 'plan_payment_included_plan_project_user_name_asc') {
        //     $payments = $payments->get()->sortBy('includedPlans.project.user.name')->paginate(10);
        // } elseif ($request->sort_type === 'plan_payment_included_plan_project_user_name_desc') {
        //     $payments = $payments->get()->sortByDesc('includedPlans.project.user.name')->paginate(10);
        // } elseif ($request->sort_type === 'plan_payment_included_plan_project_title_asc') {
        //     $payments = $payments->get()->sortBy('includedPlans.project.title')->paginate(10);
        // } elseif ($request->sort_type === 'plan_payment_included_plan_project_title_desc') {
        //     $payments = $payments->get()->sortByDesc('includedPlans.project.title')->paginate(10);
        } else {
            $payments = $payments->paginate(10);
        }
        return view('admin.payment.index', [
            'payments' => $payments
        ]);
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
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment $payment)
    {
        //
    }
}
