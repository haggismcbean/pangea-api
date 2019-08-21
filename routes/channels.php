<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// TODO - remove this one!
Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{id}', function ($user, $id) {
	$character = $user->characters()->first();

	return $character->id == (int) $id;
});

Broadcast::channel('zone.{id}', function ($user, $id) {
	$character = $user->characters()->first();

	if ($character->zone_id == (int) $id) {
		return ['id' => $character->id, 'name' => $character->name];
	}
});

Broadcast::channel('group.{id}', function ($user, $id) {
	$character = $user->characters()->first();

	if ($character->group_id == (int) $id) {
		return ['id' => $character->id, 'name' => $character->name];
	}
});