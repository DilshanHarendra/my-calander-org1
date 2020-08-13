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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1'], function () {

    Route::post('register', 'Account\RegisterController@register');
    Route::post('login', 'Account\AuthController@login');
    Route::post('password/reset', 'Account\PasswordController@resetEmail');
    Route::get('me', 'Account\ProfileController@selfProfile');

    Route::group(['prefix' => '{account}'], function () {

        Route::get('/', 'TestController@index'); // TEST

        //Payments
        Route::group(['prefix' => 'settings', 'namespace' => 'Tenant'], function () {

            /**
             * Implement the account edit and account view feature
             */
            Route::get('account', 'AccountsController@showProfile');
            Route::post('account', 'AccountsController@updateProfile');
            Route::delete('account', 'AccountsController@destroy');

            /**
             * Account Invitation feature
             */
            Route::get('invites', 'InviteController@getAllInvites');
            Route::post('invites', 'InviteController@process');
            Route::delete('invites/{invite}', 'InviteController@destroy');

            /**
             * Account user feature
             */
            Route::get('users', 'UsersController@index');
            Route::put('users/{user}', 'UsersController@update');
            Route::delete('users/{user}', 'UsersController@destory');

            /**
             * Account Subscription feature
             */
            Route::get('billing', 'SubscriptionsController@index');
            Route::post('billing', 'SubscriptionsController@store');
            Route::put('billing', 'SubscriptionsController@updateSubscription');
            Route::delete('billing/{id}', 'SubscriptionsController@destory');
        });


        //calendar
        Route::group(['prefix' => 'calendars', 'namespace' => 'Calendar'], function () {

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
        Route::group(['prefix' => 'events', 'namespace' => 'Event'], function () {
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


Route::group(['prefix' => 'v1', 'namespace' => 'Api\Admin'], function () {
    Route::apiResource('users', 'UsersController');
    Route::apiResource('users', 'AccountsController');
});
