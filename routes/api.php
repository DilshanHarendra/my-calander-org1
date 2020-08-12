<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//
//
//Route::post('login', 'AuthController@login');
//Route::post('logout', 'AuthController@logout');
//Route::post('refresh', 'AuthController@refresh');
//Route::post('me', 'AuthController@me');


Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1', 'middleware' => ['api']], function () {

    Route::post('register', 'RegisterController@register');
    Route::post('login', 'AuthController@login');
    Route::post('password/reset', 'PasswordController@resetEmail');
    Route::get('me', 'ProfileController@selfProfile');

    Route::group(['prefix' => '{account}'], function () {

        Route::get('/', 'TestController@index'); // TEST
        //calendar
        Route::group(['prefix' => 'calendars', 'namespace'=>'Calendar'], function () {

            Route::get('/', 'CalendarController@index');
            Route::get('/{id}', 'CalendarController@show');
            Route::post('/', 'CalendarController@store');
            Route::put('/{id}', 'CalendarController@update');
            Route::delete('/{id}', 'CalendarController@delete');

        });

        //event
        Route::group(['prefix' => 'events', 'namespace'=>'Event'], function () {
            Route::get('/', 'EventController@index');
            Route::get('/{id}', 'EventController@show');
            Route::post('/', 'EventController@store');
            Route::put('/{id}', 'EventController@update');
            Route::delete('/{id}', 'EventController@delete');

        });
    });


});
