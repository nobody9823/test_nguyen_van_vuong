<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\MyProjectController;
use App\Http\Requests\MyPlanRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        DB::beginTransaction();
        try {
            Plan::find($request->plan_id)->fill($request->all())->save();
            DB::commit();
            return redirect()->action([MyProjectController::class, 'edit'], ['project' => $project, 'next_tab' => 'return'])->with(['flash_message' => 'リターン編集に成功しました。']);
        } catch(\Exception $e) {
            DB::rollback();
            throw $e;
            return redirect()->action([MyProjectController::class, 'edit'], ['project' => $project, 'next_tab' => 'return'])->withErrors(['リターン編集に失敗しました。']);
        }
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
        $this->authorize('checkOwnPlan', $plan);
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

    public function createReturn(Project $project)
    {
        return response()->json($project->plans()->save(Plan::initialize())->toArray());
    }

    public function updateReturn(Project $project, Plan $plan, MyPlanRequest $request)
    {
        return response()->json(['result' => $plan->fill($request->all())->save()]);
    }

    public function deletePlan(Project $project, Plan $plan)
    {
        $this->authorize('checkOwnPlan', $plan);
        if(Auth::user()->projects()->find($project->id)->plans()->find($plan) !== null){
            return response()->json([ 'result' => $plan->delete()]);
        };
        return response()->json(['result' => false]);
    }
}
