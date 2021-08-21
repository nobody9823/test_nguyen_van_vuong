<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
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
     * check owned by executor
     *
     *@return void
     */
    public function checkOwnedByExecutor(User $user, Payment $payment)
    {
        return $payment->project->user->id === $user->id;
    }

    /**
     * check owned by supporter
     *
     *@return void
     */
    public function checkOwnedBySupporter(User $user, Payment $payment)
    {
        return $payment->user->id === $user->id;
    }
}
