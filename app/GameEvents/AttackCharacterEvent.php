<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Message;
use App\Events\MessageSent;

class AttackCharacterEvent
{
    public function handle($activeCharacter) {
        // okay so first, we find all the characters in the same location as this one!
        // $locationId = $activeCharacter->location_id;

        // $characters = Location::find($locationId)->characters()->get();

        // foreach ($characters as $nearbyCharacter) {
        //     $message = $nearbyCharacter->messages()->create([
        //         'message' => $request->input('message'),
        //         'source' => 'character',
        //         'sourceName' => $activeCharacter->name
        //     ]);

        //     if ($nearbyCharacter->id !== $activeCharacter->id) {
        //         broadcast(new MessageSent($nearbyCharacter, $message));
        //     }
        // }
        $message = $activeCharacter->messages()->create([
            'message' => 'mate i done fucked you up',
            'source_type' => 'character',
            'source_name' => $activeCharacter->name,
            'source_id' => $activeCharacter->id,
        ]);
        broadcast(new MessageSent($activeCharacter, $message));
    }
}
