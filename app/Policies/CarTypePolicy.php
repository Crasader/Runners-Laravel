<?php

namespace App\Policies;

use App\User;
use App\CarType;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * CarTypePolicy
 *
 * @author Bastien Nicoud
 * @package App\Policies
 */
class CarTypePolicy
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
     * Determine whether the user can view the carType.
     *
     * @param  \App\User  $user
     * @param  \App\CarType  $carType
     * @return mixed
     */
    public function view(User $user, CarType $carType)
    {
        return true;
    }

    /**
     * Determine whether the user can create carTypes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->may('manage_car_types');
    }

    /**
     * Determine whether the user can update the carType.
     *
     * @param  \App\User  $user
     * @param  \App\CarType  $carType
     * @return mixed
     */
    public function update(User $user, CarType $carType)
    {
        return $user->may('manage_car_types');
    }

    /**
     * Determine whether the user can delete the carType.
     *
     * @param  \App\User  $user
     * @param  \App\CarType  $carType
     * @return mixed
     */
    public function delete(User $user, CarType $carType)
    {
        return $user->may('manage_car_types');
    }
}
