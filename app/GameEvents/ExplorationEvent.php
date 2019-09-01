<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Message;
use App\Events\MessageSent;

use App\WorldGenerator\ExplorationMessageGenerator;

class ExplorationEvent
{
    public function handle($character, $description, $changeType, $changeId) {
        // Special case where we need to send description of mine to the event
        if ($description !== 'SUCCESS' && $description !== 'FAILURE' && $description !== 'DEATH') {
            $message = $character->messages()->create([
                'message' => "You wander through the wilderness. Before long you stumble across something. " . $description,
                'source_type' => 'character',
                'source_name' => $character->getName($character),
                'source_id' => $character->id,
                'change' => $changeType,
                'change_id' => $changeId
            ]); 

            broadcast(new MessageSent($character, $message));

            if ($changeType === 'group') {
                // we have to sign everyone else up for the group too.
                $groupCharacters = $character->group()->first()->characters()->where('id', '!=', $character->id)->get();

                foreach ($groupCharacters as $groupCharacter) {
                    $message = $groupCharacter->messages()->create([
                        'message' => "A new person suddenly appears.",
                        'source_type' => 'group',
                        'source_name' => $character->getName($groupCharacter),
                        'source_id' => $character->id,
                        'change' => $changeType,
                        'change_id' => $changeId
                    ]);

                    broadcast(new MessageSent($groupCharacter, $message));
                }
            }

            return;
        }

        // If it's not a special case, the user didn't find anything so we give a failure message
        $message = $character->messages()->create([
            'message' => ExplorationMessageGenerator::getFailureMessage(),
            'source_type' => 'character',
            'source_name' => $character->getName($character),
            'source_id' => $character->id,
        ]);

        broadcast(new MessageSent($character, $message));
    }
}
