<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SearchRequest;
use App\Models\Option;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plans = Plan::search()->withProjectId($request->project)
                                ->searchWithPrice($request->min_price, $request->max_price)
                                ->searchWithEstimatedReturnDate($request->from_date, $request->to_date)
                                ->paginate(10);
        
        $project = Project::find($request->project);

        return view(
            'admin.plan.index',
            [
            'project' => $project,
            'plans' => $plans,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('admin.plan.create', ['project' => $project]);
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
            $plan->project_id = $project->id;
            $plan->fill($request->all())->save();
            // NOTE:現状オプションは使用しない為、コメントアウト
            // $plan->saveOptions($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('プランの作成に失敗しました。管理会社にご連絡をお願いします。');
        }

        return redirect()
            ->action([PlanController::class, 'index'], ['project' => $project, 'plans' => $project->plans()->paginate(10)])
            ->with('flash_message', 'プラン作成が成功しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('admin.plan.show', ['plan' => $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Plan $plan)
    {
        return view(
            'admin.plan.edit',
            [
            'project' => $project,
            'plan' => $plan,
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, Project $project, Plan $plan)
    {
        DB::beginTransaction();
        try {
            $plan->project_id = $project->id;
            $plan->fill($request->all())->save();
            // NOTE:現状オプションは使用しない為、コメントアウト
            // $plan->saveOptions($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('プランの更新に失敗しました。管理会社にご連絡をお願いします。');
        }

        return redirect()
            ->action([PlanController::class, 'index'], ['project' => $project, 'plans' => $project->plans()->paginate(10)])
            ->with('flash_message', 'プラン更新が成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $plan->deleteImage();
        $plan->delete();
        $plans = Plan::paginate(10);
        return redirect()->action([PlanController::class, 'index'], ['project' => $plan->project, 'plans' => $plans])->with('flash_message', 'プラン削除が成功しました。');
    }

    /**
     * Display preview of the project
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview(Project $project, Plan $plan)
    {
        return view('admin.plan.preview', ['project' => $project, 'plan' => $plan]);
    }

    public function deleteImage(Plan $plan)
    {
        Storage::delete($plan->image_url);
        $plan->image_url = "public/sampleImage/now_printing.png";
        $plan->save();
        return response()->json('success');
    }

    // NOTE:現状オプションは使用しない為、コメントアウト
    // public function deleteOption(Option $option)
    // {
    //     $option->delete();
    //     return response()->json('success');
    // }
}
