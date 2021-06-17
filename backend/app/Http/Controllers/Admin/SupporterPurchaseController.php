<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserPlanCheering;
use App\Http\Requests\SearchRequest;

class SupporterPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supporter_purchases = UserPlanCheering::with(['user', 'plan', 'plan.project.talent.company', 'plan.project.talent', 'plan.project', ])->paginate(10);
        return view('admin.supporter_purchase.index', compact('supporter_purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
        //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
        //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
        //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
        //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
        //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
        //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $request)
    {
        $supporter_purchases = UserPlanCheering::searchWords($request->getArrayWords())
                                                ->searchPurchaseDate($request->from_date, $request->to_date)
                                                ->searchPurchasePrice($request->price)
                                                ->orderBy('created_at', 'desc')
                                                ->paginate(10);
        $supporter_purchases->load('plan', 'plan.project.talent.company', 'plan.project', 'plan.project.talent', 'user');
        return view('admin.supporter_purchase.index', [
            'supporter_purchases' => $supporter_purchases,
            'word' => $request->getWords(),
        ]);
    }
}
