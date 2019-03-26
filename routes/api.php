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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('posts', 'PostController@index');
	Route::get('posts/{post}', 'PostController@show');
	Route::post('posts', 'PostController@store');
	Route::put('posts/{post}', 'PostController@update');
	Route::delete('posts/{post}', 'PostController@delete');
});

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('password/email', 'Auth\ForgotPasswordController@getResetToken');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// chat messages
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('messages', 'ChatsController@fetchMessages');
	Route::post('messages', 'ChatsController@sendMessage');
});

// character creation
Route::group(['middleware' => 'auth:api'], function() {
	Route::post('character', 'CharacterController@create');
	Route::get('characters', 'CharacterController@show');
});

// resouce gathering
Route::group(['middleware' => 'auth:api'], function() {
	Route::put('gather', 'PlantController@gather');
});

// travelling and location
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('zone/{zone}/borders', 'ZoneController@getBorderingZones');
	Route::post('zone/{zone}/move', 'ZoneController@changeZones');
});

// current location
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('zone/{zone}', 'ZoneController@description');
	Route::get('zone/{zone}/characters', 'ZoneController@characters');
	Route::get('zone/{zone}/plants', 'ZoneController@plants');
});

// combat
Route::group(['middleware' => 'auth:api'], function() {
	Route::post('character/{character}/attack', 'CharacterController@attack');
});

// inventory
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('character/{character}/inventory', 'CharacterController@inventory');
	Route::put('put_down', 'CharacterController@putDown');
	Route::get('zone/{zone}/inventory', 'ZoneController@inventory');
	// Route::put('pick_up', 'ZoneController@pickUp');
});

////////////
// World generation (note to self: remove these endpoints or make them private :P)
Route::get('world', 'WorldController@show');
Route::get('plant', 'PlantController@show');
Route::get('animal', 'AnimalController@show');
//
////////////