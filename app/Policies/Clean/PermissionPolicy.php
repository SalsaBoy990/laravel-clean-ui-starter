<?php

namespace App\Policies\Clean;

use App\Models\Clean\Permission;
use App\Models\Clean\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     *
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        return $user->hasRoles('super-administrator');
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Permission  $permission
     *
     * @return Response|bool
     */
    public function view(User $user, Permission $permission): Response|bool
    {
        return $user->hasPermissionTo('manage-permissions');
    }


    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     *
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return $user->hasPermissionTo('manage-permissions');
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Permission  $permission
     *
     * @return Response|bool
     */
    public function update(User $user, Permission $permission): Response|bool
    {
        return $user->hasPermissionTo('manage-permissions');
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Permission  $permission
     *
     * @return Response|bool
     */
    public function delete(User $user, Permission $permission): Response|bool
    {
        return $user->hasPermissionTo('manage-permissions');
    }


    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Permission  $permission
     *
     * @return Response|bool
     */
    public function restore(User $user, Permission $permission): Response|bool
    {
        return false;
    }


    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Permission  $permission
     *
     * @return Response|bool
     */
    public function forceDelete(User $user, Permission $permission): Response|bool
    {
        return false;
    }
}
