<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Report;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reports = Report::search()->narrowDownWithProject()->sortBySelected($request->sort_type)->paginate(10);
        return view('admin.report.index', ['project' => $request->project, 'reports' => $reports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('admin.report.create', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportRequest $request, Report $report, Project $project)
    {
        DB::beginTransaction();
        try {
            $report->fill($request->fillWithProjectId($project->id))->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('活動報告の作成に失敗しました。管理会社に連絡をお願いします。');
        }

        $reports = $project->reports()->paginate(10);
        return redirect()->action([ReportController::class, 'index'], ['project' => $project, 'reports' => $reports])->with('flash_message', '新規作成が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return view('admin.report.show', ['report' => $report]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Report $report)
    {
        return view('admin.report.edit', ['project' => $project, 'report' => $report]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReportRequest $request, Project $project, Report $report)
    {
        DB::beginTransaction();
        try {
            $report->fill($request->fillWithProjectId($project->id))->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors('活動報告の作成に失敗しました。管理会社に連絡をお願いします。');
        }

        $reports = $project->reports()->paginate(10);
        return redirect()->action([ReportController::class, 'index'], ['project' => $project, 'reports' => $reports])->with('flash_message', '更新が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Report $report)
    {
        DB::beginTransaction();
        try {
            Storage::delete($report->image_url);
            $report->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        $reports = $project->reports()->paginate(10);
        return redirect()->action([ReportController::class, 'index'], ['project' => $project, 'reports' => $reports])->with('flash_message', '削除が完了しました。');
    }

    public function deleteImage(Request $request, Report $report)
    {
        Storage::delete($request->report['image_url']);

        $report = Report::find($request->report['id']);
        $report->image_url = "public/sampleImage/now_printing.png";
        $report->save();
        return response()->json('success');
    }
}
