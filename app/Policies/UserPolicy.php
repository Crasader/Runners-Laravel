<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * UserPolicy
 *
 * @author Bastien Nicoud
 * @package App\Policies
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Check the authorization before all checks
     * Used in most case to authorize the admin
     *
     * @return mixed
     */
    public function before($user, $ability)
    {
        if ($user->is('root')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        // You can manage your acount
        if ($user->id === $model->id) {
            return true;
        }
        // If you have the permission to manage other acounts
        return $user->may('manage_other_users');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->may('create_users');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        // You can manage your account
        if ($user->id === $model->id) {
            return true;
        }
        // If you have the permission to manage other accounts
        return $user->may('manage_other_users');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->may('delete_users');
    }

    /**
     * Determine whether the authenticated user can change the password of this user
     *
     * @param  \App\User  $user The authenticated user
     * @param  \App\User  $model The user where we want to update the pass
     * @return mixed
     */
    public function changePass(User $user, User $model)
    {
        // You can manage your account
        if ($user->id === $model->id) {
            return true;
        }
        return $user->may('manage_other_users');
    }
}
