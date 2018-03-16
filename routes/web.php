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

// Return the full vue
Route::get('/', 'HomeController@index');
//Route::view('/', 'index');

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/chauffeurs', function () {
    return view('runners');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
