<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Routes for the laravel authentication system
 */
Auth::routes();

/**
 * Homepage
 */
Route::get('/', 'HomeController@index')->name('index');

/**
 * Routes protected by the auth middleware
 */
Route::middleware(['auth'])->group(function () {

    /**
     * Connected home page
     */
    Route::get('/home', 'HomeController@home')->name('home');


    /** *****************************
     * Users resource
     */
    // Qr codes management
    Route::get('users/{user}/generate-qr-code', 'User\UserQrCodeController@store')
        ->name('users.generate-qr-code');
    Route::get('users/{user}/delete-qr-code', 'User\UserQrCodeController@destroy')
        ->name('users.delete-qr-code');
    // Credentials management
    Route::get('users/{user}/generate-credentials', 'User\UserController@generateCredentials')
        ->name('users.generate-credentials');
    // Import system (csv file)
    Route::get('users/import', 'User\UserController@import')->name('users.import-form');
    Route::post('users/import', 'User\UserController@import')->name('users.import');
    // Users route for searching in users table (used by search field)
    Route::post('users/search', 'User\UserController@search')->name('users.search');
    // Dedicated route for users pass
    Route::get('users/{user}/pass', 'User\UserController@updatePassForm')->name('users.pass.edit');
    Route::patch('users/{user}/pass', 'User\UserController@updatePass')->name('users.pass.update');
    // The user crud
    Route::resource('users', 'User\UserController');
    // User comments crud
    Route::resource('users.comments', 'User\UserCommentController', ['only' => ['store', 'destroy']]);
    // User profile picture crud
    Route::resource(
        'users.profile-picture',
        'User\UserProfilePictureController',
        ['only' => ['store', 'destroy'], 'parameters' => ['profile-picture' => 'attachment']]
    );
    // User licence picture crud
    Route::resource(
        'users.licence-picture',
        'User\UserLicencePictureController',
        ['only' => ['store', 'destroy'], 'parameters' => ['licence-picture' => 'attachment']]
    );
    // the curently authenticated user
    Route::get('/me', 'User\UserController@me')->name('me');


    /** *****************************
     * Role crud
     */
    Route::resource('roles', 'Role\RoleController');


    /** *****************************
     * Cars ressource
     */
    // Car route for searching in users table (used by search field)
    Route::post('cars/search', 'car\CarController@search')->name('cars.search');
    Route::resource('cars', 'car\CarController');


    /** *****************************
     * CarTypes ressource
     */
    // CarTypes route for searching in users table (used by search field)
    Route::post('carTypes/search', 'car\CarTypeController@search')->name('carTypes.search');
    Route::resource('carTypes', 'car\CarTypeController');


    /** *****************************
     * Schedules ressource
     */
    // This route return all the events in json format for the calendar system
    Route::post('schedules/events', 'schedule\ScheduleController@events')->name('schedules.events');
    Route::resource('schedules', 'schedule\ScheduleController');


    /** *****************************
     * Groups ressource
     */
    Route::get('groups/manager', 'Group\GroupController@manager')->name('groups.manager');
    Route::put('groups/manager', 'Group\GroupController@managerUpdate')->name('groups.manager.update');
    Route::resource('groups', 'Group\GroupController');


    /** *****************************
     * Runs ressource
     */
    // Display runs for TV screen
    Route::get('runs/big', 'Run\RunController@big')->name('runs.big');
    Route::get('runs/print/{run}', 'Run\RunController@print')->name('runs.print');
    // Publish a run (visible in the mobile app)
    Route::patch('runs/publish/{run}', 'Run\RunController@publish')->name('runs.publish');
    // Start/stop a run
    Route::patch('runs/start/{run}', 'Run\RunController@start')->name('runs.start');
    Route::patch('runs/stop/{run}', 'Run\RunController@stop')->name('runs.stop');
    // Force start/stop of a run (for needs_filling runs)
    Route::patch('runs/force-start/{run}', 'Run\RunController@forceStart')->name('runs.force-start');
    Route::patch('runs/force-stop/{run}', 'Run\RunController@forceStop')->name('runs.force-stop');
    Route::resource('runs', 'Run\RunController');
    // Run comments crud
    Route::resource('runs.comments', 'Run\RunCommentController', ['only' => ['store', 'destroy']]);


    /** *****************************
     * Stats crud
     */
    Route::resource('statistics', 'Statistic\StatisticController');


    /** *****************************
     * Artists crud
     */
    // Specific route for the autocomplete fields
    Route::post('artists/search', 'Artist\ArtistController@search')->name('artists.search');
    Route::resource('artists', 'Artist\ArtistController');


    /** *****************************
     * Waypoints crud
     */
    // Specific route for the autocomplete fields
    Route::post('waypoints/search', 'Waypoint\WaypointController@search')->name('waypoints.search');
    Route::resource('waypoints', 'Waypoint\WaypointController');


    /** *****************************
     * Kiela crud
     */
    Route::resource(
        'kiela',
        'Kiela\KielaController',
        ['only' => ['index', 'create', 'store' ,'destroy']]
    );


    /** *****************************
     * Logs crud
     */
    Route::resource(
        'logs',
        'Log\LogController',
        ['only' => ['index']]
    );


    /** *****************************
     * Notifications crud
     */
    Route::get('notifications/read', 'Notification\NotificationController@read')->name('notifications.read');
    Route::resource(
        'notifications',
        'Notification\NotificationController',
        ['only' => ['index', 'show', 'destroy']]
    );

    /**
     * Connected home page
     */
    Route::get('/infos', 'HomeController@infos')->name('infos');
});
