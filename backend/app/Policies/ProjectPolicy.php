<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\PlanPaymentIncluded;
use App\Models\Project;
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

    public function checkOwnProject(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }

    public function checkIsFinishedPayment(User $user, Project $project)
    {
        $check_purchased = $project->payments->where('user_id',$user->id);        
        return $check_purchased->isNotEmpty() ? true : false;
    }
}
