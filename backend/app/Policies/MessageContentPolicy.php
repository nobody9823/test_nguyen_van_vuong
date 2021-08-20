<?php

namespace App\Policies;

use App\Models\MessageContent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessageContentPolicy
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
     * @param  \App\Models\MessageContent  $messageContent
     * @return mixed
     */
    public function view(User $user, MessageContent $messageContent)
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
     * @param  \App\Models\MessageContent  $messageContent
     * @return mixed
     */
    public function update(User $user, MessageContent $messageContent)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MessageContent  $messageContent
     * @return mixed
     */
    public function delete(User $user, MessageContent $messageContent)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MessageContent  $messageContent
     * @return mixed
     */
    public function restore(User $user, MessageContent $messageContent)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MessageContent  $messageContent
     * @return mixed
     */
    public function forceDelete(User $user, MessageContent $messageContent)
    {
        //
    }

    /**
     * check owned by executor
     *
     *@return void
     */
    public function checkOwnedByExecutor(User $user, MessageContent $message_content)
    {
        return $message_content->payment->project->user->id === $user->id;
    }

    /**
     * check owned by supporter
     *
     *@return void
     */
    public function checkOwnedBySupporter(User $user, MessageContent $message_content)
    {
        return $message_content->payment->user->id === $user->id;
    }
}
