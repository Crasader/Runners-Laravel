<?php

namespace App\Policies;

use App\User;
use App\Waypoint;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * ArtistPolicy
 *
 * @author Bastien Nicoud
 * @package App\Policies
 */
class WaypointPolicy
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
     * Determine whether the user can view the waypoint.
     *
     * @param  \App\User  $user
     * @param  \App\Waypoint  $waypoint
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create waypoints.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->may('manage_waypoints');
    }

    /**
     * Determine whether the user can update the waypoint.
     *
     * @param  \App\User  $user
     * @param  \App\Waypoint  $waypoint
     * @return mixed
     */
    public function update(User $user, Waypoint $waypoint)
    {
        return $user->may('manage_waypoints');
    }

    /**
     * Determine whether the user can delete the waypoint.
     *
     * @param  \App\User  $user
     * @param  \App\Waypoint  $waypoint
     * @return mixed
     */
    public function delete(User $user, Waypoint $waypoint)
    {
        return $user->may('manage_waypoints');
    }
}
