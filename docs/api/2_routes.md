# Api routes

| Domain | Method    | URI                               | Name                  | Action                                                                 | Middleware   |
|--------|-----------|-----------------------------------|-----------------------|------------------------------------------------------------------------|--------------|
|        | GET-HEAD  | /                                 |                       | App\Http\Controllers\HomeController@index                              | web          |
|        | GET-HEAD  | api/cars                          | cars.index            | App\Http\Controllers\api\CarController@index                           | api,auth:api |
|        | POST      | api/cars                          | cars.store            | App\Http\Controllers\api\CarController@store                           | api,auth:api |
|        | PUT-PATCH | api/cars/{car}                    | cars.update           | App\Http\Controllers\api\CarController@update                          | api,auth:api |
|        | GET-HEAD  | api/cars/{car}                    | cars.show             | App\Http\Controllers\api\CarController@show                            | api,auth:api |
|        | POST      | api/cars/{car}/comments           | cars.comments.store   | App\Http\Controllers\api\CarCommentController@store                    | api,auth:api |
|        | GET-HEAD  | api/cars/{car}/comments           | cars.comments.index   | App\Http\Controllers\api\CarCommentController@index                    | api,auth:api |
|        | DELETE    | api/cars/{car}/comments/{comment} | cars.comments.destroy | App\Http\Controllers\api\CarCommentController@destroy                  | api,auth:api |
|        | PUT-PATCH | api/cars/{car}/comments/{comment} | cars.comments.update  | App\Http\Controllers\api\CarCommentController@update                   | api,auth:api |
|        | GET-HEAD  | api/cars/{car}/comments/{comment} | cars.comments.show    | App\Http\Controllers\api\CarCommentController@show                     | api,auth:api |
|        | GET-HEAD  | api/groups                        | groups.index          | App\Http\Controllers\api\GroupController@index                         | api,auth:api |
|        | GET-HEAD  | api/groups/{group}                | groups.show           | App\Http\Controllers\api\GroupController@show                          | api,auth:api |
|        | GET-HEAD  | api/me                            |                       | App\Http\Controllers\api\UserController@me                             | api,auth:api |
|        | GET-HEAD  | api/me/runs                       |                       | App\Http\Controllers\api\RunController@myRuns                          | api,auth:api |
|        | GET-HEAD  | api/me/workinghours               |                       | App\Http\Controllers\api\ScheduleController@myWorkingHours             | api,auth:api |
|        | PATCH     | api/runners/{user}                |                       | App\Http\Controllers\api\RunController@runner                          | api,auth:api |
|        | GET-HEAD  | api/runs                          | runs.index            | App\Http\Controllers\api\RunController@index                           | api,auth:api |
|        | GET-HEAD  | api/runs/{run}                    | runs.show             | App\Http\Controllers\api\RunController@show                            | api,auth:api |
|        | POST      | api/runs/{run}/start              |                       | App\Http\Controllers\api\RunController@start                           | api,auth:api |
|        | POST      | api/runs/{run}/stop               |                       | App\Http\Controllers\api\RunController@stop                            | api,auth:api |
|        | GET-HEAD  | api/runs/{run}/waypoints          | runs.waypoints.index  | App\Http\Controllers\api\RunWaypointController@index                   | api,auth:api |
|        | GET-HEAD  | api/shedules                      | shedules.index        | App\Http\Controllers\api\ScheduleController@index                      | api,auth:api |
|        | GET-HEAD  | api/users                         | users.index           | App\Http\Controllers\api\UserController@index                          | api,auth:api |
|        | GET-HEAD  | api/users/{user}                  | users.show            | App\Http\Controllers\api\UserController@show                           | api,auth:api |
|        | GET-HEAD  | api/waypoints                     | waypoints.index       | App\Http\Controllers\api\WaypointController@index                      | api,auth:api |
|        | GET-HEAD  | api/waypoints/search              |                       | App\Http\Controllers\api\WaypointController@search                     | api,auth:api |
|        | GET-HEAD  | api/waypoints/{waypoint}          | waypoints.show        | App\Http\Controllers\api\WaypointController@show                       | api,auth:api |
|        | GET-HEAD  | chauffeurs                        |                       | Closure                                                                | web          |
|        | GET-HEAD  | login                             | login                 | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST      | login                             |                       | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | POST      | logout                            | logout                | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST      | password/email                    | password.email        | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | GET-HEAD  | password/reset                    | password.request      | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | POST      | password/reset                    |                       | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET-HEAD  | password/reset/{token}            | password.reset        | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | GET-HEAD  | register                          | register              | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST      | register                          |                       | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |

<br>
<br>
<br>
<hr>

**Helpful links :**
* [Homestead docs](https://laravel.com/docs/5.5/homestead)

<hr>
<div align="center">

**[<- Prev](1_arch.md) // [Summary](../README.md) // [Next ->](3_errors.md)**

</div>