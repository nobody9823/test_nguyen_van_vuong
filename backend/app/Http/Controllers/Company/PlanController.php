<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use Storage;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plans = Plan::getPlansByCompany()
                    ->withProjectId($request->project)
                    ->with('project')->paginate(10);

        $project = $request->project ? Project::find($request->project) : null;
        return view('company.plan.index',
        [
            'plans' => $plans,
            'project' => $project,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Project $project)
    {
        $request->contribution ? $contribution = 'contribution' : $contribution = null;
        return view('company.plan.create',
        [
            'project' => $project,
            'contribution' => $contribution,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request, Project $project, Plan $plan)
    {
        DB::beginTransaction();
        try {
            if ($request->contribution) {
                $plan->saveContributionPlans($request, $project);
            } else {
                $plan->project_id = $project->id;
                $plan->fill($request->all())->save();
            }
            $plan->saveOptions($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('プランの作成に失敗しました。管理会社にご連絡をお願いします。');
        }

        return redirect()
            ->action([PlanController::class, 'search'], ['project' => $project, 'plans' => $project->plans()->paginate(10)])
            ->with('flash_message', 'プラン作成が成功しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        $this->authorize('checkOwnPlanAsCompany', [$plan, 'show']);
        return view('company.plan.show', ['plan' => $plan->load('options')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Project $project, Plan $plan)
    {
        $this->authorize('checkOwnPlanAsCompany', [$plan, 'edit']);
        $request->contribution ? $contribution = 'contribution' : $contribution = null;
        return view('company.plan.edit', [
            'project' => $project,
            'plan' => $plan->load('options'),
            'contribution' => $contribution,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, Project $project, Plan $plan)
    {
        $this->authorize('checkOwnPlanAsCompany', [$plan, 'update']);
        DB::beginTransaction();
        try {
            if ($request->contribution) {
                $plan->saveContributionPlans($request, $project);
            } else {
                $plan->project_id = $project->id;
                $plan->fill($request->all())->save();
            }
            $plan->saveOptions($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('プランの更新に失敗しました。管理会社にご連絡をお願いします。');
        }

        return redirect()
            ->action([PlanController::class, 'search'], ['project' => $project, 'plans' => $project->plans()->paginate(10)])
            ->with('flash_message', 'プラン更新が成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $this->authorize('checkOwnPlanAsCompany', [$plan, 'destroy']);
        $plan->deleteImage();
        $plan->delete();
        $plans = Plan::paginate(10);
        return redirect()->action([PlanController::class, 'search'], ['project' => $plan->project, 'plans' => $plans])->with('flash_message', 'プラン削除が成功しました。');
    }

    /**
     * Display preview of the project
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview(Project $project, Plan $plan)
    {
        $this->authorize('checkOwnPlanAsCompany', [$plan, 'preview']);
        return view('company.plan.preview', ['project' => $project, 'plan' => $plan]);
    }

    public function deleteImage(Plan $plan)
    {
        $this->authorize('checkOwnPlanAsCompany', [$plan, 'deleteImage']);
        Storage::delete($plan->image_url);
        $plan->image_url = "public/sampleImage/now_printing.png";
        $plan->save();
        return response()->json('success');
    }

    public function deleteOption(Option $option)
    {
        $this->authorize('checkOwnOptionAsCompany', $option);
        $option->delete();
        return response()->json('success');
    }

    public function search(SearchRequest $request)
    {
        $plans = Plan::searchByWords($request->getArrayWords())
            ->withProjectId($request->project)
            ->searchWithPrice($request->min_price, $request->max_price)
            ->searchWithEstimatedReturnDate($request->from_date, $request->to_date)
            ->getPlansByCompany()
            ->paginate(10);

            $project = Project::find($request->project);
        return view('company.plan.index', [
            'project' => $project,
            'plans' => $plans,
        ]);
    }

}
