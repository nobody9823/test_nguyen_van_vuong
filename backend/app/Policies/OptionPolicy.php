<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Option;
use App\Models\Talent;
use Illuminate\Auth\Access\HandlesAuthorization;

class OptionPolicy
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
    public function checkOwnOptionAsCompany(Company $company, Option $option)
    {
        return $company->id === $option->plan->project->talent->company_id
            && $option->plan->project->release_status !== '掲載中' && $option->plan->project->release_status !== '承認待ち';
    }

    public function checkOwnOptionAsTalent(Talent $talent, Option $option)
    {
        return $talent->id === $option->plan->project->talent_id
            && $option->plan->project->release_status !== '掲載中' && $option->plan->project->release_status !== '承認待ち';
    }
}
