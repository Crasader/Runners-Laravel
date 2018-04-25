<?php

namespace App\Policies;

use App\User;
use App\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * GroupPolicy
 *
 * @author Bastien Nicoud
 * @package App\Policies
 */
class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Check the authorization before all cheks
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
     * Determine whether the user can view the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->may('manage_groups');
    }

    /**
     * Determine whether the user can update the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->may('manage_groups');
    }

    /**
     * Determine whether the user can delete the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->may('manage_groups');
    }
}
