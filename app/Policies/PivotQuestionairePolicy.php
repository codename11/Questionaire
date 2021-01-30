<?php

namespace App\Policies;

use App\PivotQuestionaire;
use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PivotQuestionairePolicy
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
     * @param  \App\PivotQuestionaire  $pivotQuestionaire
     * @return mixed
     */
    public function view(User $user, PivotQuestionaire $pivotQuestionaire)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() ? Response::allow() : Response::deny('Access denied.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\PivotQuestionaire  $pivotQuestionaire
     * @return mixed
     */
    public function update(User $user, PivotQuestionaire $pivotQuestionaire)
    {
        return $user->isAdmin() ? Response::allow() : Response::deny('Access denied.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\PivotQuestionaire  $pivotQuestionaire
     * @return mixed
     */
    public function delete(User $user, PivotQuestionaire $pivotQuestionaire)
    {
        return $user->isAdmin() ? Response::allow() : Response::deny('Access denied.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\PivotQuestionaire  $pivotQuestionaire
     * @return mixed
     */
    public function restore(User $user, PivotQuestionaire $pivotQuestionaire)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\PivotQuestionaire  $pivotQuestionaire
     * @return mixed
     */
    public function forceDelete(User $user, PivotQuestionaire $pivotQuestionaire)
    {
        //
    }
}
