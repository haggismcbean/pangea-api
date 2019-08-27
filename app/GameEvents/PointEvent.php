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

        if (!$character->zone()->first()->parent_id) {
            $characters = Group::find($character->group_id)->characters()->get();
        } else {
            $characters = Zone::find($zoneId)->characters()->get();
        }

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
