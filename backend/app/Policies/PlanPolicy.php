<?php

namespace App\Policies;
use App\Models\User;
use App\Models\Plan;
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
    public function checkOwnPlan(User $user, Plan $plan)
    {
        return $user->id === $plan->project->user_id;
    }
}
