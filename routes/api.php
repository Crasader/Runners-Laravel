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

Route::middleware('auth:api')->get('/tutu', function (Request $request) {
    return "TUTU";
});

// Some suplementary routes for the resources
// This declarations must be before the ressource déclaration
Route::get('/me/workinghours', 'api\ScheduleController@workinghours');

// All the resources déclarations
Route::apiResources([
    'users'     => 'api\UserController',
    'carTypes'  => 'api\CarTypeController',
    'cars'      => 'api\CarController',
    'groups'    => 'api\GroupController',
    'schedules' => 'api\ScheduleController'
]);
