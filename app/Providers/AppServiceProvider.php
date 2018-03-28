<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Disable the api ressources wrapping to a 'data' key
         */
        Resource::withoutWrapping();

        /**
         * Log all the sql queries in a log file
         */
        \DB::listen(function ($query) {
            \Log::info($query->sql, $query->bindings);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
