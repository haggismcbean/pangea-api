<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Events\MessageSent;

class CharacterSpeakEvent
{
    public function handle($sourceCharacter, $targetCharacter, $message) {
        // okay so first, we find all the characters in the same location as this one!
        $locationId = $sourceCharacter->location_id;

        $character = Location::find($locationId)->characters()->where('id', $targetCharacter->id)->first();

        $message = $character->messages()->create([
            'message' => $message,
            'source_type' => 'character',
            'source_name' => $sourceCharacter->name,
            'source_id' => $sourceCharacter->id,
        ]);

        if ($character->id !== $sourceCharacter->id) {
            broadcast(new MessageSent($character, $message));
        }
    }
}
