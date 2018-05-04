<?php

namespace App\Policies;

use App\User;
use App\Artist;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * ArtistPolicy
 *
 * @author Bastien Nicoud
 * @package App\Policies
 */
class ArtistPolicy
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
     * Determine whether the user can view the artist.
     *
     * @param  \App\User  $user
     * @param  \App\Artist  $artist
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create artists.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->may('manage_artists');
    }

    /**
     * Determine whether the user can update the artist.
     *
     * @param  \App\User  $user
     * @param  \App\Artist  $artist
     * @return mixed
     */
    public function update(User $user, Artist $artist)
    {
        return $user->may('manage_artists');
    }

    /**
     * Determine whether the user can delete the artist.
     *
     * @param  \App\User  $user
     * @param  \App\Artist  $artist
     * @return mixed
     */
    public function delete(User $user, Artist $artist)
    {
        return $user->may('manage_artists');
    }
}
