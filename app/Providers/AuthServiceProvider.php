<?php

namespace App\Providers;

use App\Run;
use App\Car;
use App\User;
use App\Role;
use App\Group;
use App\Artist;
use App\Comment;
use App\CarType;
use App\Schedule;
use App\Policies\RunPolicy;
use App\Policies\CarPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\GroupPolicy;
use App\Policies\ArtistPolicy;
use App\Policies\CommentPolicy;
use App\Policies\CarTypePolicy;
use App\Policies\SchedulePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class     => UserPolicy::class,
        Schedule::class => SchedulePolicy::class,
        Group::class    => GroupPolicy::class,
        Car::class      => CarPolicy::class,
        CarType::class  => CarTypePolicy::class,
        Run::class      => RunPolicy::class,
        Role::class     => RolePolicy::class,
        Comment::class  => CommentPolicy::class,
        Artist::class   => ArtistPolicy::class
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
