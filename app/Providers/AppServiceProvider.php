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
        setlocale(LC_TIME, config('app.locale'));
        Carbon::setLocale(config('app.locale'));

        /**
         * Declare global components alias (used to simply import components)
         */
        Blade::component('components/status_tag', 'statustag');
        Blade::component('components/horizontal_form_input', 'horizontalinput');
        Blade::component('components/horizontal_search_input', 'horizontalsearchinput');
        Blade::component('components/log_action', 'logaction');
        Blade::component('components/date_tag', 'datetag');
        Blade::component('components/date_text', 'datetext');
        Blade::component('components/date', 'date');
        Blade::component('components/foldable_box', 'foldable');
        Blade::component('components/runs/waypoints_breadcrum', 'waypoints');

        /**
         * Log all the sql queries in a log file
         */
        if (config('app.debug') == true) {
            \DB::listen(function ($query) {
                \Log::info("DATABASE QUERY : " . $query->sql, $query->bindings);
            });
        }
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
