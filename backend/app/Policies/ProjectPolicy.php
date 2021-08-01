<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\PlanPaymentIncluded;
use App\Models\Project;
use App\Models\ProjectFile;
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

    // FIXME: paymentsテーブルにproject_idが追加されたのでそれに合わせて要修正
    public function checkIsFinishedPayment(User $user, Project $project)
    {
        $plans = $project->plans()->whereIn(
            'id',PlanPaymentIncluded::query()->select('plan_id')->whereIn(
            'payment_id',Payment::query()->select('id')->where(
            'user_id', $user->id
        )))->get();

        return $plans->isNotEmpty() ? true : false;
    }
}
