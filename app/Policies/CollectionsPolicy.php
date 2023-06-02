<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Collections;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollectionsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the collections can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allcollections');
    }

    /**
     * Determine whether the collections can view the model.
     */
    public function view(User $user, Collections $model): bool
    {
        return $user->hasPermissionTo('view allcollections');
    }

    /**
     * Determine whether the collections can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allcollections');
    }

    /**
     * Determine whether the collections can update the model.
     */
    public function update(User $user, Collections $model): bool
    {
        return $user->hasPermissionTo('update allcollections');
    }

    /**
     * Determine whether the collections can delete the model.
     */
    public function delete(User $user, Collections $model): bool
    {
        return $user->hasPermissionTo('delete allcollections');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allcollections');
    }

    /**
     * Determine whether the collections can restore the model.
     */
    public function restore(User $user, Collections $model): bool
    {
        return false;
    }

    /**
     * Determine whether the collections can permanently delete the model.
     */
    public function forceDelete(User $user, Collections $model): bool
    {
        return false;
    }
}
