<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Schedule;
use App\Group;
use App\Policies\SchedulePolicy;
use App\Policies\GroupPolicy;
use App\Car;
use App\Policies\CarPolicy;
use App\CarType;
use App\Policies\CarTypePolicy;
use App\User;
use App\Policies\UserPolicy;
use App\Run;
use App\Policies\RunPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'     => 'App\Policies\ModelPolicy',
        User::class     => UserPolicy::class,
        Schedule::class => SchedulePolicy::class,
        Group::class    => GroupPolicy::class,
        Car::class      => CarPolicy::class,
        CarType::class  => CarTypePolicy::class,
        Run::class      => RunPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
