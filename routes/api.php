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
Route::middleware(['auth:api'])->group(function () {

    /**
     * The current user
     */
    Route::get('me', 'api\UserController@me');
    // DEPRECATED old route to get the current user
    Route::get('users/me', 'api\UserController@me');

    /**
     * Routes prefixed by me
     * Retrive infos for the connected user
     */
    Route::prefix('me')->group(function () {
        /**
         * The working hours of the connected user
         */
        Route::get('workinghours', 'api\ScheduleController@myWorkingHours');
        /**
         * The runs of the current user
         */
        Route::get('runs', 'api\RunController@myRuns');
    });

    /**
     * Users ressource
     */
    Route::apiResource('users', 'api\UserController', ['only' => ['index', 'show']]);

    /**
     * Shedules ressource
     */
    Route::apiResource('shedules', 'api\ScheduleController', ['only' => ['index']]);

    /**
     * Runs ressource
     */
    // Spcific route to start the run
    Route::post('/runs/{run}/start', 'api\RunController@start');
    // Specific route to stop the run
    Route::post('/runs/{run}/stop', 'api\RunController@stop');
    // The ressource
    Route::apiResource('runs', 'api\RunController', ['only' => ['index', 'show']]);
    // The waypoints nested in the runs
    Route::apiResource('runs.waypoints', 'api\RunWaypointController', ['only' => ['index']]);

    /**
     * Runners resource
     * This resource is used to access the run_driver table
     */
    // Specific route to change car or user for a run
    Route::patch('/runners/{user}', 'api\RunController@runner');

    /**
     * Waypoints ressource
     */
    // Specific route to search waypoints
    Route::get('waypoints/search', 'api\WaypointController@search');
    Route::apiResource('waypoints', 'api\WaypointController', ['only' => ['index', 'show']]);

    /**
     * Cars resource
     */
    Route::apiResource('cars', 'api\CarController', ['only' => ['index', 'show', 'store', 'update']]);
    // DEPRECATED old route name for cars
    Route::apiResource('vehicles', 'api\CarController', ['only' => ['index', 'show', 'store', 'update']]);
    // Comments for a car
    Route::apiResource('cars.comments', 'api\CarCommentController');
    //DEPRECATED old route name for cars comments
    Route::apiResource('vehicles.comments', 'api\CarCommentController');

    /**
     * Groups resource
     */
    Route::apiResource('groups', 'api\GroupController', ['only' => ['index', 'show']]);
});
