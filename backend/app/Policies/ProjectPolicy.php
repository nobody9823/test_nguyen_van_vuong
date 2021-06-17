<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Project;
use App\Models\Talent;
use App\Models\User;
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

    public function checkOwnProjectAsCompany(Company $company, Project $project, $action)
    {
        return ($action === 'show' || $action === "preview")
            ? $company->id === $project->talent->company_id
            : $company->id === $project->talent->company_id
                && $project->release_status !== '掲載中' && $project->release_status !== '承認待ち';
    }

    public function checkOwnProjectAsTalent(Talent $talent, Project $project, $action)
    {
        return ($action === 'show' || $action === "preview")
            ? $talent->id === $project->talent_id
            : $talent->id === $project->talent_id
                && $project->release_status !== '掲載中' && $project->release_status !== '承認待ち';
    }
}
