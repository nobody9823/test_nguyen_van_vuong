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
            'reports' => $reports
        ]);
    }
}
