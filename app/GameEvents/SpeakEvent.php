<?php

namespace App\GameEvents;

use App\Character;
use App\Zone;
use App\Events\MessageSent;

class SpeakEvent
{
    public function handle($activeCharacter, $speach) {
        // okay so first, we find all the characters in the same location as this one!
        $locationId = $activeCharacter->zone_id;

        $characters = Zone::find($locationId)->characters()->get();

        foreach ($characters as $nearbyCharacter) {
            $message = $nearbyCharacter->messages()->create([
                'message' => $speach,
                'source_type' => 'character',
                'source_name' => $activeCharacter->getName($nearbyCharacter),
                'source_id' => $activeCharacter->id,
            ]);

            if ($nearbyCharacter->id !== $activeCharacter->id) {
                broadcast(new MessageSent($nearbyCharacter, $message));
            }
        }

    }
}
