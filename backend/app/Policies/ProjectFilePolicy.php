<?php

namespace App\Policies;

use App\Models\ProjectFile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectFilePolicy
{
    use HandlesAuthorization;

    public function checkOwnProjectFiles(User $user, ProjectFile $project_file)
    {
        if(($project_file->project->release_status === "---" || $project_file->project->release_status === "差し戻し") &&  
          ($user->id === $project_file->project->user_id)) {
            return true;
        } else {
            return false;
        }
    }
}
