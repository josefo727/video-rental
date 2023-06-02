<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Series;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeriesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the series can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allseries');
    }

    /**
     * Determine whether the series can view the model.
     */
    public function view(User $user, Series $model): bool
    {
        return $user->hasPermissionTo('view allseries');
    }

    /**
     * Determine whether the series can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allseries');
    }

    /**
     * Determine whether the series can update the model.
     */
    public function update(User $user, Series $model): bool
    {
        return $user->hasPermissionTo('update allseries');
    }

    /**
     * Determine whether the series can delete the model.
     */
    public function delete(User $user, Series $model): bool
    {
        return $user->hasPermissionTo('delete allseries');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allseries');
    }

    /**
     * Determine whether the series can restore the model.
     */
    public function restore(User $user, Series $model): bool
    {
        return false;
    }

    /**
     * Determine whether the series can permanently delete the model.
     */
    public function forceDelete(User $user, Series $model): bool
    {
        return false;
    }
}
