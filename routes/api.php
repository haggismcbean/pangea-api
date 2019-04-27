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
	Route::put('character/put_down', 'CharacterController@putDown');
	Route::get('zone/{zone}/inventory', 'ZoneController@inventory');
	Route::put('zone/pick_up', 'ZoneController@pickUp');
});

// crafting
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('character/{character}/get_craftables', 'CharacterController@getCraftables');
	Route::get('zone/{zone}/activities', 'ZoneController@activities');
	Route::put('activity/create_new_activity', 'ActivityController@createNewActivity');
	Route::post('activity/add_item_to_activity', 'ActivityController@addItemToActivity');
	Route::post('activity/work_on_activity', 'ActivityController@createWorkOnActivityJob');
	Route::post('activity/stop_working_on_activity', 'ActivityController@stopWorkingOnActivity');
	Route::post('activity/cancel_activity', 'ActivityController@cancelActivity');
});

// hunting
Route::group(['middleware' => 'auth:api'], function() {
	Route::post('character/hunt', 'HuntController@huntAnimal');
});

// farming
Route::group(['middleware' => 'auth:api'], function() {
	// Route::post('character/farm', 'FarmController@createPlot');
	// Route::post('character/farm', 'FarmController@plant');
	// Route::post('character/farm', 'FarmController@fertilize');
	// Route::post('character/farm', 'FarmController@till');
	// // Route::post('character/farm', 'FarmController@irrigate');
	// Route::post('character/farm', 'FarmController@harvest');
});

////////////
// World generation (note to self: remove these endpoints or make them private :P)
Route::get('world', 'WorldController@show');
Route::get('plant', 'PlantController@show');
Route::get('animal', 'AnimalController@show');
//
////////////