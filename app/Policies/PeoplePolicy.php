<?php

namespace App\Policies;

use App\Models\User;
use App\Models\People;
use Illuminate\Auth\Access\HandlesAuthorization;

class PeoplePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the people can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allpeople');
    }

    /**
     * Determine whether the people can view the model.
     */
    public function view(User $user, People $model): bool
    {
        return $user->hasPermissionTo('view allpeople');
    }

    /**
     * Determine whether the people can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allpeople');
    }

    /**
     * Determine whether the people can update the model.
     */
    public function update(User $user, People $model): bool
    {
        return $user->hasPermissionTo('update allpeople');
    }

    /**
     * Determine whether the people can delete the model.
     */
    public function delete(User $user, People $model): bool
    {
        return $user->hasPermissionTo('delete allpeople');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allpeople');
    }

    /**
     * Determine whether the people can restore the model.
     */
    public function restore(User $user, People $model): bool
    {
        return false;
    }

    /**
     * Determine whether the people can permanently delete the model.
     */
    public function forceDelete(User $user, People $model): bool
    {
        return false;
    }
}
