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
    Route::get('users/{user}/generate-qr-code', 'UserController@generateQrCode')->name('users.generate-qr-code');
    Route::get('users/{user}/generate-credentials', 'UserController@generateCredentials')->name('users.generate-credentials');
    Route::resource('users', 'UserController');
    Route::resource('users.comments', 'UserCommentController');
    // the curently authenticated user
    Route::get('/me', 'UserController@me')->name('me');

    Route::resource('cars', 'car\CarController');
    Route::resource('cartypes', 'car\CarTypeController');
});
