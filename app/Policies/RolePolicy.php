<?php

namespace App\Policies;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
     * @param  \App\Models\Roles  $roles
     * @return mixed
     */
    public function view(User $user, Roles $roles)
    {
        return $user->hasPermissionTo('Ver roles') 
        || $user->hasRole('admin')
        || $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Crear roles') 
        || $user->hasRole('admin')
        || $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roles  $roles
     * @return mixed
     */
    public function update(User $user, Roles $roles)
    {
        if ($roles->id === 1 || $roles->id === 2) {
            return false;
        }
        return $user->hasPermissionTo('Actualizar roles') 
        || $user->hasRole('admin')
        || $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roles  $roles
     * @return mixed
     */
    public function delete(User $user, Roles $roles)
    {
        if ($roles->id === 1 || $roles->id === 2) {
            $this->deny('No se puede eliminar este rol');
        }
        return $user->hasPermissionTo('Eliminar roles') 
        || $user->hasRole('admin')
        || $user->hasRole('super-admin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roles  $roles
     * @return mixed
     */
    public function restore(User $user, Roles $roles)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roles  $roles
     * @return mixed
     */
    public function forceDelete(User $user, Roles $roles)
    {
        //
    }
}
