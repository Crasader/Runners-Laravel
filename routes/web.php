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

    /**
     * Users ressource
     */
    // Qr codes management
    Route::get('users/{user}/generate-qr-code', 'User\UserQrCodeController@store')
        ->name('users.generate-qr-code');
    Route::get('users/{user}/delete-qr-code', 'User\UserQrCodeController@destroy')
        ->name('users.delete-qr-code');
    // Credentials managment
    Route::get('users/{user}/generate-credentials', 'User\UserController@generateCredentials')
        ->name('users.generate-credentials');
    // Import system (csv file)
    Route::get('users/import', 'User\UserController@import')->name('users.import-form');
    Route::post('users/import', 'User\UserController@import')->name('users.import');
    // Users route for searching in users table (used by search field)
    Route::post('users/search', 'User\UserController@search')->name('users.search');
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

    /**
     * Role crud
     */
    Route::resource('roles', 'Role\RoleController');

    /**
     * Cars ressource
     */
    Route::resource('cars', 'car\CarController');

    /**
     * CarTypes ressource
     */
    Route::resource('carTypes', 'car\CarTypeController');

    /**
     * Schedules ressource
     */
    Route::resource('schedules', 'schedule\ScheduleController');

    /**
     * Groups ressource
     */
    Route::get('groups/manager', 'Group\GroupController@manager')->name('groups.manager');
    Route::put('groups/manager', 'Group\GroupController@managerUpdate')->name('groups.manager.update');
    Route::resource('groups', 'Group\GroupController');

    /**
     * Runs ressource
     */
    Route::get('runs/big', 'Run\RunController@big')->name('runs.big');
    Route::resource('runs', 'Run\RunController');

    /**
     * Stats crud
     */
    Route::get('stats', 'Stats\StatsController@index')->name('stats.index');

    /**
     * Artists crud
     */
    // Import system (csv file)
    Route::get('artists/import', 'Artist\ArtistController@import')->name('artists.import-form');
    Route::post('artists/import', 'Artist\ArtistController@import')->name('artists.import');
    // Specific route for the autocomplete fields
    Route::post('artists/search', 'Artist\ArtistController@search')->name('artists.search');
    Route::resource('artists', 'Artist\ArtistController');

    /**
     * Waypoints crud
     */
    // Import system (csv file)
    Route::get('waypoints/import', 'Waypoint\WaypointController@import')->name('waypoints.import-form');
    Route::post('waypoints/import', 'Waypoint\WaypointController@import')->name('waypoints.import');
    // Specific route for the autocomplete fields
    Route::post('waypoints/search', 'Waypoint\WaypointController@search')->name('waypoints.search');
    Route::resource('waypoints', 'Waypoint\WaypointController');
});
