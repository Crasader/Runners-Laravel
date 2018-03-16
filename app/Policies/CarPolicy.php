<?php

namespace App\Policies;

use App\User;
use App\Car;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * CarPolicy
 *
 * @author Bastien Nicoud
 * @package App\Policies
 */
class CarPolicy
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
     * Determine whether the user can view the car.
     *
     * @param  \App\User  $user
     * @param  \App\Car  $car
     * @return mixed
     */
    public function view(User $user, Car $car)
    {
        return true;
    }

    /**
     * Determine whether the user can create cars.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->may('manage_cars');
    }

    /**
     * Determine whether the user can update the car.
     *
     * @param  \App\User  $user
     * @param  \App\Car  $car
     * @return mixed
     */
    public function update(User $user, Car $car)
    {
        return $user->may('manage_cars');
    }

    /**
     * Determine whether the user can delete the car.
     *
     * @param  \App\User  $user
     * @param  \App\Car  $car
     * @return mixed
     */
    public function delete(User $user, Car $car)
    {
        return $user->may('manage_cars');
    }
}
