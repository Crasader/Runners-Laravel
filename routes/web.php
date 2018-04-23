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
 * Return a swagger view
 * Descripe all the api routes (generated with the swagger editor)
 */
//Route::view('/api', 'swagger');

/**
 * Homepage
 */
Route::get('/', 'HomeController@index');

/**
 * Routes protected by the auth middleware
 */
Route::middleware(['auth'])->group(function () {

    /**
     * Connected home page
     */
    Route::get('/home', 'HomeController@home');

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
    // Ressources
    Route::resource('users', 'User\UserController');
    Route::resource('users.comments', 'User\UserCommentController');
    Route::resource('users.profile-picture', 'User\UserProfilePictureController');
    Route::resource('users.liscence-picture', 'User\UserLicencePictureController');
    // the curently authenticated user
    Route::get('/me', 'User\UserController@me')->name('me');

    /**
     * Cars ressource
     */
    Route::resource('cars', 'car\CarController');

    /**
     * CarTypes ressource
     */
    Route::resource('cartypes', 'car\CarTypeController');
});
