<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\PlanPaymentIncluded;
use App\Models\Project;
use App\Models\User;
use App\Models\Admin;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
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

    public function checkOwnProject(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }

    public function checkOwnProjectWithPublishedStatus(User $user, Project $project)
    {
        if (($project->release_status === "---" || $project->release_status === "差し戻し") &&  ($user->id === $project->user_id)) {
            return true;
        } else {
            return false;
        }
    }

    public function checkOwnProjectWithPublishedStatusForRepoert(User $user, Project $project)
    {
        if (($project->release_status === "掲載中" || $project->release_status === "掲載停止中") && ($user->id === $project->user_id)) {
            return true;
        } else {
            return false;
        }
    }
}
