<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Report;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function checkOwnReportWithPublishedStatus(User $user, Report $report)
    {
        if(($report->project->release_status === "掲載中" || $report->project->release_status === "掲載停止中") && ($user->id === $report->project->user_id)) {
            return true;
        } else {
            return false;
        }
    }
}
