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

    Route::post('logout', 'AuthController@logout');

    Route::post('refresh', 'AuthController@refresh');

    Route::get('me', 'AuthController@me');


//    Route::post('password/reset', 'PasswordController@resetEmail');


    Route::group(['prefix' => '{account}'], function () {

        Route::post('/', 'TestController@index'); // TEST

        // PLACE REST OF THE ROUTES WHICH SUPPOSE TO BE UNDER ACCOUNT ROUTE

    });


});
