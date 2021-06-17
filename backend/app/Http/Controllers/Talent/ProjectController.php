<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SearchRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::getProjectsByTalent();

        return view('talent.project.index', [
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
        $categories = Category::pluckNameAndId();
        return view('talent.project.create', [
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
            $project->fill($request->allWithTalentId())->save();
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
        $this->authorize('checkOwnProjectAsTalent', [$project, 'show']);
        $plans = $project->plans;
        return view('talent.project.show', [
            'project' => $project->load('projectImages', 'plans', 'plans.users', 'activityReports'),
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
        $this->authorize('checkOwnProjectAsTalent', [$project, 'edit']);
        $categories = Category::pluckNameAndId();
        return view('talent.project.edit', [
            'project' => $project,
            'categories' => $categories,
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
        $this->authorize('checkOwnProjectAsTalent', [$project, 'update']);
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
        $this->authorize('checkOwnProjectAsTalent', [$project, 'destroy']);
        DB::beginTransaction();
        try {
            $project->deleteProjectImages();
            $project->delete();
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors('プロジェクトの削除に失敗しました。管理会社に連絡をお願いします。');
        }
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
        $this->authorize('checkOwnProjectAsTalent', [$project, 'preview']);
        $plans = $project->plans;
        return view('talent.project.preview', [
            'project' => $project,
            'plans' => $plans,
        ]);
    }

    public function deleteImage(ProjectImage $project_image)
    {
        $project_image->deleteImage();
        return response()->json('success');
    }

    public function search(SearchRequest $request)
    {
        $projects = Project::with('talent')->SearchByArrayWords($request->getArrayWords())
                            ->searchWithReleaseStatus($request->release_statuses)
                            ->getProjectsByTalent();

        return view('talent.project.index', [
            'projects' => $projects,
        ]);
    }

    public function approvalRequest(Project $project)
    {
        $this->authorize('checkOwnProjectAsTalent', [$project, 'approvalRequest']);
        if ($project->release_status === "---" || $project->release_status === "差し戻し" || $project->release_status === '掲載停止中'){
            $project->release_status = '承認待ち';
            return $project->save() ?
                redirect()->back()->with('flash_message', "承認申請が完了しました。") :
                redirect()->back()->withErrors('承認申請に失敗しました。');
        }
        redirect()->back()->withErrors('承認申請に失敗しました。');
    }
}
