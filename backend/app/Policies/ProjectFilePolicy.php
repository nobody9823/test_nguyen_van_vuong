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
        return $user->id === $project_file->project->user_id;
    }
}
