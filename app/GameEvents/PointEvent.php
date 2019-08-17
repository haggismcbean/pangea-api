<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Events\MessageSent;

class PointEvent
{
    public function handle($activeCharacter, $targetCharacter) {
        // okay so first, we find all the characters in the same location as this one!
        $locationId = $activeCharacter->location_id;

        $characters = Location::find($locationId)->characters()->get();

        foreach ($characters as $nearbyCharacter) {
            $message = $nearbyCharacter->messages()->create([
                'message' => $activeCharacter->name . ' points at ' . $targetCharacter->name,
                'source_type' => 'character',
                'source_name' => $activeCharacter->name,
                'source_id' => $activeCharacter->id,
            ]);

            broadcast(new MessageSent($nearbyCharacter, $message));
        }

    }
}
