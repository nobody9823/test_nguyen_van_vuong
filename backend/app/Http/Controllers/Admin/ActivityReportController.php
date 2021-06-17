<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityReportRequest;
use App\Http\Requests\SearchRequest;
use App\Models\ActivityReport;
use App\Models\ActivityReportImage;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ActivityReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activity_reports = ActivityReport::getActivityReports();
        return view('admin.activity_report.index', ['project' => null, 'activity_reports' => $activity_reports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('admin.activity_report.create', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityReportRequest $request, ActivityReport $activity_report, Project $project)
    {
        DB::beginTransaction();
        try {
            $activity_report
                ->fill($request->fillWithProjectId($project->id))
                ->save();
            $activity_report->activityReportImages()->saveMany($request->ImagesToArray());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('活動報告の作成に失敗しました。管理会社に連絡をお願いします。');
        }

        $activity_reports = $project->activityReports()->paginate(10);
        return redirect()->action([ActivityReportController::class, 'search'], ['project' => $project, 'activity_reports' => $activity_reports])->with('flash_message', '新規作成が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityReport $activity_report)
    {
        return view('admin.activity_report.show', ['activity_report' => $activity_report]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, ActivityReport $activity_report)
    {
        return view('admin.activity_report.edit', ['project' => $project, 'activity_report' => $activity_report, 'images' => $activity_report->activityReportImages]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityReportRequest $request, Project $project, ActivityReport $activity_report)
    {
        DB::beginTransaction();
        try {
            $activity_report
                ->fill($request->fillWithProjectId($project->id))
                ->save();
            $activity_report->activityReportImages()->saveMany($request->ImagesToArray());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('活動報告の作成に失敗しました。管理会社に連絡をお願いします。');
        }

        $activity_reports = $project->activityReports()->paginate(10);
        return redirect()->action([ActivityReportController::class, 'search'], ['project' => $project, 'activity_reports' => $activity_reports])->with('flash_message', '更新が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, ActivityReport $activity_report)
    {
        DB::beginTransaction();
        try {
            $activity_report->deleteImages();
            $activity_report->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        $activity_reports = $project->activityReports()->paginate(10);
        return redirect()->action([ActivityReportController::class, 'search'], ['project' => $project, 'activity_reports' => $activity_reports])->with('flash_message', '削除が完了しました。');
    }

    public function deleteImage(ActivityReportImage $activityReportImage)
    {
        Storage::delete($activityReportImage->image_url);
        $activityReportImage->delete();
        return response()->json('success');
    }

    public function search(SearchRequest $request)
    {
        $activity_reports = ActivityReport::searchByArrayWords($request->getArrayWords())
                                            ->withProjectId($request->project)
                                            ->with('project')->paginate(10);

        $project = Project::find($request->project);

        return view('admin.activity_report.index', [
            'activity_reports' => $activity_reports,
            'project' => $project,
            ]);
    }

}
