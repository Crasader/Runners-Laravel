<?php

namespace App\Policies;

use App\User;
use App\Run;
use Illuminate\Auth\Access\HandlesAuthorization;

class RunPolicy
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
     * Determine whether the user can view the run.
     *
     * @param  \App\User  $user
     * @param  \App\Run  $run
     * @return mixed
     */
    public function view(User $user, Run $run)
    {
        return true;
    }

    /**
     * Determine whether the user can create runs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->may('manage_runs');
    }

    /**
     * Determine whether the user can update the run.
     *
     * @param  \App\User  $user
     * @param  \App\Run  $run
     * @return mixed
     */
    public function update(User $user, Run $run)
    {
        return $user->may('manage_runs');
    }

    /**
     * Determine whether the user can delete the run.
     *
     * @param  \App\User  $user
     * @param  \App\Run  $run
     * @return mixed
     */
    public function delete(User $user, Run $run)
    {
        return $user->may('manage_runs');
    }

    /**
     * Determine whether the user can start a run.
     *
     * @param  \App\User  $user
     * @param  \App\Run  $run
     * @return mixed
     */
    public function start(User $user, Run $run)
    {
        return $user->may('start_run');
    }

    /**
     * Determine whether the user can stop a run.
     *
     * @param  \App\User  $user
     * @param  \App\Run  $run
     * @return mixed
     */
    public function stop(User $user, Run $run)
    {
        return $user->may('end_run');
    }

    /**
     * Determine whether the user can force start a run.
     *
     * @param  \App\User  $user
     * @param  \App\Run  $run
     * @return mixed
     */
    public function forceStart(User $user, Run $run)
    {
        return $user->may('force_start_run');
    }

    /**
     * Determine whether the user can force stop a run.
     *
     * @param  \App\User  $user
     * @param  \App\Run  $run
     * @return mixed
     */
    public function forceStop(User $user, Run $run)
    {
        return $user->may('force_end_run');
    }
}
