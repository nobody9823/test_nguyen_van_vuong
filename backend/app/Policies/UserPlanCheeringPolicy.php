<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Talent;
use App\Models\User;
use App\Models\UserPlanCheering;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPlanCheeringPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPlanCheering  $userPlanCheering
     * @return mixed
     */
    public function view(User $user, UserPlanCheering $userPlanCheering)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPlanCheering  $userPlanCheering
     * @return mixed
     */
    public function update(User $user, UserPlanCheering $userPlanCheering)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPlanCheering  $userPlanCheering
     * @return mixed
     */
    public function delete(User $user, UserPlanCheering $userPlanCheering)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPlanCheering  $userPlanCheering
     * @return mixed
     */
    public function restore(User $user, UserPlanCheering $userPlanCheering)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserPlanCheering  $userPlanCheering
     * @return mixed
     */
    public function forceDelete(User $user, UserPlanCheering $userPlanCheering)
    {
        //
    }

    /**
     * check owned by company
     *
     *@return void
     */
    public function checkOwnedByCompany(Company $company, UserPlanCheering $userPlanCheering)
    {
        return $userPlanCheering->plan->project->talent->company->id === $company->id;
    }

    /**
     * check owned by talent
     *
     *@return void
     */
    public function checkOwnedByTalent(Talent $talent, UserPlanCheering $userPlanCheering)
    {
        return $userPlanCheering->plan->project->talent->id === $talent->id;
    }

    /**
     * check owned by user
     *
     *@return void
     */
    public function checkOwnedByUser(User $user, UserPlanCheering $userPlanCheering)
    {
        return $userPlanCheering->user->id === $user->id;
    }
}
