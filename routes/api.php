<?php

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

    /** *****************************
     * The current user
     */
    Route::get('me', 'api\UserController@me');
    // DEPRECATED old route to get the current user
    Route::get('users/me', 'api\UserController@me');

    /** *****************************
     * Routes prefixed by me
     * Retrieve info's for the connected user
     */
    Route::prefix('me')->group(function () {
        /**
         * The working hours of the connected user
         */
        Route::get('workinghours', 'api\ScheduleController@workingHours');
        /**
         * The runs of the current user
         */
        Route::get('runs', 'api\RunController@myRuns');
    });

    /** *****************************
     * Users resource
     */
    Route::apiResource('users', 'api\UserController', ['only' => ['index', 'show']]);

    /** *****************************
     * Schedules resource
     */
    Route::apiResource('schedules', 'api\ScheduleController', ['only' => ['index']]);

    /** *****************************
     * Runs resource
     */
    // Deprecated ! Specific route to start the run (used in the mobile app)
    Route::post('/runs/{run}/start', 'api\RunController@start');
    // Starts a run
    Route::patch('/runs/{run}/start', 'api\RunController@start');
    // Deprecated ! Specific route to stop the run (used in the mobile app)
    Route::post('/runs/{run}/stop', 'api\RunController@stop');
    // Ends a run
    Route::patch('/runs/{run}/stop', 'api\RunController@stop');
    // The resource
    Route::apiResource('runs', 'api\RunController', ['only' => ['index', 'show']]);
    // The waypoint's nested in the runs
    Route::apiResource('runs.waypoints', 'api\RunWaypointController', ['only' => ['index']]);

    /** *****************************
     * Runners resource
     * This resource is used to access the run_driver table
     */
    Route::patch('/runners/{id}/driver', 'api\RunnerController@associateRunner');
    Route::patch('/runners/{id}/car', 'api\RunnerController@associateCar');
    Route::apiResource('runners', 'api\RunnerController', ['only' => ['show', 'update']]);

    /** *****************************
     * Waypoints resource
     */
    // Specific route to search waypoints
    Route::get('waypoints/search', 'api\WaypointController@search');
    Route::apiResource('waypoints', 'api\WaypointController', ['only' => ['index', 'show']]);

    /** *****************************
     * Cars resource
     */
    Route::apiResource('cars', 'api\CarController', ['only' => ['index', 'show', 'store', 'update']]);
    // DEPRECATED old route name for cars
    Route::apiResource('vehicles', 'api\CarController', [
        'only' => [
            'index', 'show', 'store', 'update'
        ], 'parameters' => [
            'vehicles' => 'car'
        ]
    ]);
    // Comments for a car
    Route::apiResource('cars.comments', 'api\CarCommentController');
    //DEPRECATED old route name for cars comments
    Route::apiResource('vehicles.comments', 'api\CarCommentController', ['parameters' => ['vehicles' => 'car']]);

    /** *****************************
     * Groups resource
     */
    Route::apiResource('groups', 'api\GroupController', ['only' => ['index', 'show']]);
});
