<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


/***
 * Accept invitation route
 */
Route::get('accept/{token}', 'InviteController@accept');


/**
 * Password reset route
 */

Route::get('password/reset/{token}', 'PasswordResetController@resetPassword');



Route::get('/events/{event}/{provider}', 'Event\EventController@provider');


