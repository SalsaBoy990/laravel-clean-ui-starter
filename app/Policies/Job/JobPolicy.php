<?php

namespace App\Policies\Job;

use App\Models\Clean\User;
use App\Models\Job\Job;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class JobPolicy
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
        return $user->hasRoles('super-administrator|administrator');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Job  $job
     *
     * @return Response|bool
     */
    public function view(User $user, Job $job): Response|bool
    {
        return $user->hasRoles('super-administrator|administrator');
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
        return $user->hasRoles('super-administrator|administrator');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Job  $job
     *
     * @return Response|bool
     */
    public function update(User $user, Job $job): Response|bool
    {
        return $user->hasRoles('super-administrator|administrator');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Job  $job
     *
     * @return Response|bool
     */
    public function delete(User $user, Job $job): Response|bool
    {
        return $user->hasRoles('super-administrator|administrator');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Job  $job
     *
     * @return Response|bool
     */
    public function restore(User $user, Job $job)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Job  $job
     *
     * @return Response|bool
     */
    public function forceDelete(User $user, Job $job)
    {
        return false;
    }
}
