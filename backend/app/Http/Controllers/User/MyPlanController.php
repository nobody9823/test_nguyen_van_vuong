<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\MyProjectController;
use App\Http\Requests\MyPlanRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Plan;

class MyPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //
    // }

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
    public function store(MyPlanRequest $request, Project $project)
    {
        $project->plans()->save(Plan::make($request->all()));
        return redirect()->action([MyProjectController::class, 'edit'], ['project' => $project, 'next_tab' => 'return'])->with(['flash_message' => 'リターンが作成されました。']);
    }

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
    public function update(Project $project, Plan $plan, MyPlanRequest $request)
    {
        $plan->fill($request->all())->save();
        return redirect()->action([MyProjectController::class, 'edit'], ['project' => $project, 'next_tab' => 'return'])->with(['flash_message' => 'リターンが更新されました。']);
    }

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
}
