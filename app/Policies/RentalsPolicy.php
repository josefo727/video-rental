<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rentals;
use Illuminate\Auth\Access\HandlesAuthorization;

class RentalsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the rentals can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allrentals');
    }

    /**
     * Determine whether the rentals can view the model.
     */
    public function view(User $user, Rentals $model): bool
    {
        return $user->hasPermissionTo('view allrentals');
    }

    /**
     * Determine whether the rentals can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allrentals');
    }

    /**
     * Determine whether the rentals can update the model.
     */
    public function update(User $user, Rentals $model): bool
    {
        return $user->hasPermissionTo('update allrentals');
    }

    /**
     * Determine whether the rentals can delete the model.
     */
    public function delete(User $user, Rentals $model): bool
    {
        return $user->hasPermissionTo('delete allrentals');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allrentals');
    }

    /**
     * Determine whether the rentals can restore the model.
     */
    public function restore(User $user, Rentals $model): bool
    {
        return false;
    }

    /**
     * Determine whether the rentals can permanently delete the model.
     */
    public function forceDelete(User $user, Rentals $model): bool
    {
        return false;
    }
}
