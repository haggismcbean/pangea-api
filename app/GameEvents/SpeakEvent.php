<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Events\MessageSent;

class SpeakEvent
{
    public function handle($activeCharacter, $request) {
        // okay so first, we find all the characters in the same location as this one!
        $locationId = $activeCharacter->location_id;

        $characters = Location::find($locationId)->characters()->get();

        foreach ($characters as $nearbyCharacter) {
            $message = $nearbyCharacter->messages()->create([
                'message' => $request->input('message'),
                'source' => 'character',
                'sourceName' => $activeCharacter->name
            ]);

            if ($nearbyCharacter->id !== $activeCharacter->id) {
                broadcast(new MessageSent($nearbyCharacter, $message));
            }
        }

    }
}