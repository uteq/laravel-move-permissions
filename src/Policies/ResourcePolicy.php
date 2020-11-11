<?php

namespace Uteq\MovePermissions\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User;

class ResourcePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasRole('Super-Admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user, $model, $resource)
    {
        return $user->canAny([
            'manage ' . $resource,
            'manage own ' . $resource,
        ]);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @return mixed
     */
    public function delete(User $user, $model, $resource)
    {
        if ($user->can('manage ' . $resource)) {
            return true;
        }

        if ($user->can('manage own ' . $resource)) {
            return $user->id == ($model->user_id ?? null);
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @return mixed
     */
    public function forceDelete(User $user, $model, $resource)
    {
        if ($user->can('forceDelete ' . $resource)) {
            return true;
        }

        if ($user->can('manage own ' . $resource) && $user->can('forceDelete ' . $resource)) {
            return $user->id == ($model->user_id ?? null);
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @return mixed
     */
    public function restore(User $user, $model, $resource)
    {
        if ($user->can('restore ' . $resource)) {
            return true;
        }

        if ($user->can('manage own ' . $resource) && $user->can('restore ' . $resource)) {
            return $user->id == ($model->user_id ?? null);
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @return mixed
     */
    public function update(User $user, $model, $resource)
    {
        if ($user->can('manage ' . $resource)) {
            return true;
        }

        if ($user->can('manage own ' . $resource)) {
            return $user->id == ($model->user_id ?? null);
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @return mixed
     */
    public function view(User $user, $model, $resource)
    {
        if ($user->can('view ' . $resource)) {
            return true;
        }

        if ($user->can('view own ' . $resource)) {
            return $user->id == $model->user_id;
        }

        return false;
    }

    /**
     * @param User $user
     */
    public function viewAny(User $user, $model, $resource)
    {
        return $user->can('view ' . $resource);
    }
}
