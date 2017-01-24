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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource("groups", "GroupController");
Route::resource('car', 'CarController');
$router->post("car/{car}/comment",["as"=>"car.comments.store","uses"=>"CarController@addComment"]);
Route::post('car/cancel', 'CarController@cancel');

Route::resource('user', 'UserController');
