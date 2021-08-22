<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Project $project)
    {
        // $this->authorize('checkOwnProject', $project);
        $reports = $project->reports()->orderBy('created_at', 'DESC')->paginate(5);
        
        return view('user.report.index', [
            'reports' => $reports,
            'project' => $project
        ]);
    }

    public function create(Project $project)
    {
        return view('user.report.create', ['project' => $project]);
    }

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

        return redirect()->action([ReportController::class, 'index'], ['project' => $project])->with('flash_message', '新規作成が完了しました。');
    }

    public function edit(Project $project, Report $report)
    {
        return view('user.report.edit', ['project' => $project, 'report' => $report]);
    }

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

        return redirect()->action([ReportController::class, 'index'], ['project' => $project])->with('flash_message', '更新が完了しました。');
    }
}
