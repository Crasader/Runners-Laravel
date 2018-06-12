<?php

namespace App\Policies;

use App\User;
use App\Kiela;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * KielaPolicy
 *
 * @author Bastien Nicoud
 * @package App\Policies
 */
class KielaPolicy
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
     * Determine whether the user can view the kiela.
     *
     * @param  \App\User  $user
     * @param  \App\Kiela  $kiela
     * @return mixed
     */
    public function view(User $user, Kiela $kiela)
    {
        return true;
    }

    /**
     * Determine whether the user can create kielas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->may('manage_kielas');
    }

    /**
     * Determine whether the user can update the kiela.
     *
     * @param  \App\User  $user
     * @param  \App\Kiela  $kiela
     * @return mixed
     */
    public function update(User $user, Kiela $kiela)
    {
        return $user->may('manage_kielas');
    }

    /**
     * Determine whether the user can delete the kiela.
     *
     * @param  \App\User  $user
     * @param  \App\Kiela  $kiela
     * @return mixed
     */
    public function delete(User $user, Kiela $kiela)
    {
        return $user->may('manage_kielas');
    }
}
