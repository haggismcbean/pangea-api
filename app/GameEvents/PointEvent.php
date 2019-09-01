<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Events\MessageSent;

class PointEvent
{
    public function handle($activeCharacter, $targetCharacter) {
        // okay so first, we find all the characters in the same location as this one!
        $zoneId = $activeCharacter->zone_id;

        if (!$character->zone()->first()->parent_zone) {
            $characters = Group::find($character->group_id)->characters()->get();
        } else {
            $characters = Zone::find($zoneId)->characters()->get();
        }

        foreach ($characters as $nearbyCharacter) {
            $message = $nearbyCharacter->messages()->create([
                'message' => $activeCharacter->getName($nearbyCharacter) . ' points at ' . $targetCharacter->getName($nearbyCharacter),
                'source_type' => 'character',
                'source_name' => $activeCharacter->getName($nearbyCharacter),
                'source_id' => $activeCharacter->id,
            ]);

            broadcast(new MessageSent($nearbyCharacter, $message));
        }

    }
}
