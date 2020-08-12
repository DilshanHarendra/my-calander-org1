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
            Route::get('/{calendar}', 'CalendarController@show');
            Route::post('/', 'CalendarController@store');
            Route::put('/{calendar}', 'CalendarController@update');
            Route::delete('/{calendar}', 'CalendarController@delete');

            //calendar-subscribers
            Route::group(['prefix' => '/{calendar}/subscribers'], function () {
                Route::get('/', 'SubscriptionController@calender_subscribers');
                Route::post('/', 'SubscriptionController@subscribe');
                Route::delete('/', 'SubscriptionController@delete');
            });
        });

        //event
        Route::group(['prefix' => 'events', 'namespace'=>'Event'], function () {
            Route::get('/', 'EventController@index');
            Route::get('/{event}', 'EventController@show');
            Route::post('/', 'EventController@store');
            Route::put('/{event}', 'EventController@update');
            Route::delete('/{event}', 'EventController@delete');

            //event-invites
            Route::group(['prefix' => '/{event}/invites'], function () {
                Route::get('/', 'InvitationController@event_invites');
                Route::post('/', 'InvitationController@invite');
            });

            //event-registrations
            Route::group(['prefix' => '/{event}/registrations'], function () {
                Route::get('/', 'RegistrationController@event_registrations');
                Route::post('/', 'RegistrationController@register');
            });

        });
    });


});
