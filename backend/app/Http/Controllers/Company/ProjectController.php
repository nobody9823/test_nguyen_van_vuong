<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\FundingModel;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Talent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::getProjectsByCompany();

        return view('company.project.index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $talents = Talent::getTalentsByCompany()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');

        return view('company.project.create', [
            'talents' => $talents,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request, Project $project)
    {
        DB::beginTransaction();
        try {
            $project->fill($request->allWithCompanyId())->save();
            // トップ画像の情報を一括保存
            $project->projectImages()->saveMany($request->imagesToArray());
            $project->saveProjectVideo($request->projectVideo());
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors('プロジェクトの作成に失敗しました。管理会社に連絡をお願いします。');
        }

        return redirect()->action([PlanController::class, 'create'], [
            'project' => $project,
        ])->with('flash_message', 'プロジェクト作成が成功しました。プランを作成してください。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('checkOwnProjectAsCompany', [$project, 'show']);
        $plans = $project->plans;
        return view('company.project.show', [
            'project' => $project,
            'plans' => $plans,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('checkOwnProjectAsCompany', [$project, 'edit']);
        $categories = Category::all()->pluck('name', 'id');
        $talents = Talent::getTalentsByCompany()->pluck('name', 'id');
        return view('company.project.edit', [
            'project' => $project,
            'categories' => $categories,
            'talents' => $talents,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $this->authorize('checkOwnProjectAsCompany', [$project, 'update']);
        DB::beginTransaction();
        try {
            $project->fill($request->allWithCompanyId())->save();
            // トップ画像の情報を一括保存
            $project->projectImages()->saveMany($request->imagesToArray());
            $project->saveProjectVideo($request->projectVideo());
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors('プロジェクトの更新に失敗しました。管理会社に連絡をお願いします。');
        }
        return redirect()->action([ProjectController::class, 'index'])->with('flash_message', '更新が成功しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('checkOwnProjectAsCompany', [$project, 'destroy']);
        $project->deleteProjectImages();
        $project->delete();
        return redirect()->action([ProjectController::class, 'index'])->with('flash_message', '削除が成功しました。');
    }

    /**
     * Display preview of the project
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function preview(Project $project)
    {
        $this->authorize('checkOwnProjectAsCompany', [$project, 'preview']);
        $plans = $project->plans;
        return view('company.project.preview', [
            'project' => $project,
            'plans' => $plans,
        ]);
    }

    public function deleteImage(ProjectImage $project_image)
    {
        Storage::delete($project_image->image_url);
        $project_image->delete();
        return response()->json('success');
    }

    public function search(SearchRequest $request)
    {
        $projects = Project::SearchByArrayWords($request->getArrayWords())
                            ->searchWithReleaseStatus($request->release_statuses)
                            ->GetProjectsByCompany();

        return view('company.project.index', [
            'projects' => $projects,
        ]);
    }

    public function approvalRequest(Project $project)
    {
        $this->authorize('checkOwnProjectAsCompany', [$project, 'approvalRequest']);
        if ($project->release_status === "---" || $project->release_status === "差し戻し" || $project->release_status === '掲載停止中'){
            $project->release_status = '承認待ち';
            return $project->save() ?
                redirect()->back()->with('flash_message', "承認申請が完了しました。") :
                redirect()->back()->withErrors('承認申請に失敗しました。');
        }
        redirect()->back()->withErrors('承認申請に失敗しました。');
    }
}
