<?php

namespace App\Policies;

use App\Models\Plan;
use App\Models\Talent;
use App\Models\Company;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
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

    /**
     * check own plan as Talent
     *
     *@return void
     */
    public function checkOwnPlanAsCompany(Company $company, Plan $plan, $action)
    {
        return ($action === 'show' || $action === "preview")
            ? $company->id === $plan->project->talent->company_id
            : $company->id === $plan->project->talent->company_id
                && $plan->project->release_status !== '掲載中' && $plan->project->release_status !== '承認待ち';
    }

    public function checkOwnPlanAsTalent(Talent $talent, Plan $plan, $action)
    {
        return ($action === 'show' || $action === "preview")
            ? $talent->id === $plan->project->talent_id
            : $talent->id === $plan->project->talent_id
                && $plan->project->release_status !== '掲載中' && $plan->project->release_status !== '承認待ち';
    }
}
