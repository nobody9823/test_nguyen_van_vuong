<?php

namespace App\Policies;

use App\Models\Identification;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IdentificationPolicy
{
    use HandlesAuthorization;

    public function checkOwnIdentificationImage(User $user, Identification $identification)
    {
        return $user->id === $identification->user_id;
    }
}
