<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VideoPerson;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPersonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the videoPerson can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list videopeople');
    }

    /**
     * Determine whether the videoPerson can view the model.
     */
    public function view(User $user, VideoPerson $model): bool
    {
        return $user->hasPermissionTo('view videopeople');
    }

    /**
     * Determine whether the videoPerson can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create videopeople');
    }

    /**
     * Determine whether the videoPerson can update the model.
     */
    public function update(User $user, VideoPerson $model): bool
    {
        return $user->hasPermissionTo('update videopeople');
    }

    /**
     * Determine whether the videoPerson can delete the model.
     */
    public function delete(User $user, VideoPerson $model): bool
    {
        return $user->hasPermissionTo('delete videopeople');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete videopeople');
    }

    /**
     * Determine whether the videoPerson can restore the model.
     */
    public function restore(User $user, VideoPerson $model): bool
    {
        return false;
    }

    /**
     * Determine whether the videoPerson can permanently delete the model.
     */
    public function forceDelete(User $user, VideoPerson $model): bool
    {
        return false;
    }
}
