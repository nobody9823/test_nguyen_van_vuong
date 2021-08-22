<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Report;
use Illuminate\Http\Request;

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

    public function store(Project $project)
    {
        return redirect()->action([ReportController::class, 'index'], ['project' => $project])->with('flash_message', '新規作成が完了しました。');
    }
}
