<?php

namespace App\Policies;

use App\Models\ObservacionTodo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ObservacionTodoPolicy
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
     * @param  \App\Models\ObservacionTodo  $observacionTodo
     * @return mixed
     */
    public function view(User $user, ObservacionTodo $observacionTodo)
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
     * @param  \App\Models\ObservacionTodo  $observacionTodo
     * @return mixed
     */
    public function update(User $user, ObservacionTodo $observacionTodo)
    {
        if ($user->id == $observacionTodo->user_id && !$observacionTodo->active) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ObservacionTodo  $observacionTodo
     * @return mixed
     */
    public function delete(User $user, ObservacionTodo $observacionTodo)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ObservacionTodo  $observacionTodo
     * @return mixed
     */
    public function restore(User $user, ObservacionTodo $observacionTodo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ObservacionTodo  $observacionTodo
     * @return mixed
     */
    public function forceDelete(User $user, ObservacionTodo $observacionTodo)
    {
        //
    }
}
