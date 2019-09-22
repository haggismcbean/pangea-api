<?php

namespace App\GameEvents;

use App\Group;
use App\Character;
use App\Location;
use App\Events\MessageSent;

class GroupSpeakEvent
{
    public function handle($activeCharacter, $message) {
        // okay so first, we find all the characters in the same location as this one!
        $groupId = $activeCharacter->group_id;

        $group = Group::find($groupId);

        if (!$group) {
            return;
        }

        $characters = $group->characters()->get();

        foreach ($characters as $nearbyCharacter) {
            $newMessage = $nearbyCharacter->messages()->create([
                'message' => $message,
                'source_type' => 'character',
                'source_name' => $activeCharacter->getName($nearbyCharacter),
                'source_id' => $activeCharacter->id,
            ]);

            if ($nearbyCharacter->id !== $activeCharacter->id) {
                broadcast(new MessageSent($nearbyCharacter, $newMessage));
            }
        }
    }
}
