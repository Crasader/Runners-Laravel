<?php

namespace App\Policies;

use App\User;
use App\Log;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * RunPolicy
 *
 * @author Bastien Nicoud
 * @package App\Policies
 */
class LogPolicy
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
     * Determine whether the user can view the log.
     *
     * @param  \App\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->may('manage_logs');
    }

    /**
     * Determine whether the user can create logs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->may('manage_logs');
    }

    /**
     * Determine whether the user can update the log.
     *
     * @param  \App\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function update(User $user, Log $log)
    {
        return $user->may('manage_logs');
    }

    /**
     * Determine whether the user can delete the log.
     *
     * @param  \App\User  $user
     * @param  \App\Log  $log
     * @return mixed
     */
    public function delete(User $user, Log $log)
    {
        return $user->may('manage_logs');
    }
}
