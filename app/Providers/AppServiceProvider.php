<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

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
         * Sets the locale for carbon dates
         */
        setlocale(LC_TIME, 'fr');
        Carbon::setLocale(LC_TIME, 'fr');

        /**
         * Declare global components alias (used to simply import components)
         */
        Blade::component('components/status_tag', 'statustag');
        Blade::component('components/horizontal_form_input', 'horizontalinput');
        Blade::component('components/horizontal_search_input', 'horizontalsearchinput');

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
