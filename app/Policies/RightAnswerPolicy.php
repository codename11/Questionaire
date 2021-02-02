<?php

namespace App\Policies;

use App\RightAnswer;
use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RightAnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\RightAnswer  $rightAnswer
     * @return mixed
     */
    public function view(User $user, RightAnswer $rightAnswer)
    {
        return $user->id ? Response::allow() : Response::deny('Access denied.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id ? Response::allow() : Response::deny('Access denied.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\RightAnswer  $rightAnswer
     * @return mixed
     */
    public function update(User $user, RightAnswer $rightAnswer)
    {
        return ($user->id === $rightAnswer->user_id || $user->role->name=="admin") ? Response::allow() : Response::deny('Access denied.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\RightAnswer  $rightAnswer
     * @return mixed
     */
    public function delete(User $user, RightAnswer $rightAnswer)
    {
        return ($user->id === $rightAnswer->user_id || $user->role->name=="admin") ? Response::allow() : Response::deny('Access denied.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\RightAnswer  $rightAnswer
     * @return mixed
     */
    public function restore(User $user, RightAnswer $rightAnswer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\RightAnswer  $rightAnswer
     * @return mixed
     */
    public function forceDelete(User $user, RightAnswer $rightAnswer)
    {
        //
    }
}
