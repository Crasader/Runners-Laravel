<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * All the restricted api routes (authentication middleware)
 */
Route::group(['middleware' => 'auth:api'], function () {
    /**
     * Resources suplementary routes
     * Must be declared before the resource declaration !
     */
    Route::get('/me/workinghours', 'api\ScheduleController@workinghours');

    /**
     * Ressources declarations
     */
    Route::apiResources([
        'users'     => 'api\UserController',
        'carTypes'  => 'api\CarTypeController',
        'cars'      => 'api\CarController',
        'groups'    => 'api\GroupController',
        'schedules' => 'api\ScheduleController',
        'waypoints' => 'api\WaypointController',
        'runs'      => 'api\RunController'
    ]);
});
