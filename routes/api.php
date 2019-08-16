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
	Route::post('character/messages', 'ChatsController@sendCharacterMessage');
});

// character creation
Route::group(['middleware' => 'auth:api'], function() {
	Route::post('character', 'CharacterController@create');
	Route::get('characters', 'CharacterController@show');
	Route::get('character/{request}/death_message', 'CharacterController@getDeathMessage');
});

// resouce gathering
Route::group(['middleware' => 'auth:api'], function() {
	Route::put('plant/gather', 'PlantController@gather');
	Route::post('plant/name', 'PlantController@name');
});

// eating
Route::group(['middleware' => 'auth:api'], function() {
	Route::post('character/eat', 'CharacterController@eat');
});

// travelling and location
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('zone/{zone}/borders', 'ZoneController@getBorderingZones');
	Route::post('zone/{zone}/move', 'ZoneController@changeZones');
});

// current location
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('zone/{zone}', 'ZoneController@description');
	Route::get('zone/{zone}/wake_up_text', 'ZoneController@wakeUpText');
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
	Route::post('character/give', 'CharacterController@give');
});

// crafting
Route::group(['middleware' => 'auth:api'], function() {
	Route::get('character/{character}/get_craftables', 'CharacterController@getCraftables');
	Route::get('zone/{zone}/activities', 'ZoneController@activities');
	Route::put('activity/create_new_activity', 'CraftingController@createNewActivity');
	Route::post('activity/add_item_to_activity', 'CraftingController@addItemToActivity');
	Route::post('activity/work_on_activity', 'CraftingController@workOnActivity');
	Route::post('activity/stop_working_on_activity', 'CraftingController@stopWorkingOnActivity');
	Route::post('activity/cancel_activity', 'CraftingController@cancelActivity');
});

// hunting
Route::group(['middleware' => 'auth:api'], function() {
	Route::post('character/hunt', 'HuntController@huntAnimal');
});

// farming
Route::group(['middleware' => 'auth:api'], function() {
	Route::post('farm/create', 'FarmController@create');
	Route::post('farm/plough', 'FarmController@plough');
	Route::post('farm/plant', 'FarmController@plant');
	Route::post('farm/fertilize', 'FarmController@fertilize');
	Route::post('farm/till', 'FarmController@till');
	// Route::post('farming/farm', 'FarmController@irrigatePlot');
	Route::post('farm/harvest', 'FarmController@harvest');
});

// mining
Route::group(['middleware' => 'auth:api'], function() {
	Route::post('mine/create', 'MiningController@create');
	Route::post('mine/mine', 'MiningController@mine');
	Route::post('mine/reinforce', 'MiningController@reinforce');
	Route::get('mine/stones', 'MiningController@listResources');
});

// exploring
Route::group(['middleware' => 'auth:api'], function() {
	Route::post('zone/explore', 'ExplorationController@explore');
});

////////////
// World generation (note to self: remove these endpoints or make them private :P)
Route::get('world', 'WorldController@show');
Route::get('plant', 'PlantController@show');
Route::get('animal', 'AnimalController@show');
//
////////////