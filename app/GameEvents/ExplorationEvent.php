<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Message;
use App\Events\MessageSent;

use App\WorldGenerator\ExplorationMessageGenerator;

class ExplorationEvent
{
    public function handle($character, $isSuccess) {
        // Special case where we need to send description of mine to the event
        if ($isSuccess !== 'SUCCESS' && $isSuccess !== 'FAILURE' && $isSuccess !== 'DEATH') {
            $message = $character->messages()->create([
                'message' => "You wander through the wilderness. Before long you stumble across something. " . $isSuccess,
                'source_type' => 'character',
                'source_name' => $character->name,
                'source_id' => $character->id,
            ]);

            broadcast(new MessageSent($character, $message));

            return;
        }

        // If it's not a special case, the user didn't find anything so we give a failure message
        $message = $character->messages()->create([
            'message' => ExplorationMessageGenerator::getFailureMessage(),
            'source_type' => 'character',
            'source_name' => $character->name,
            'source_id' => $character->id,
        ]);

        broadcast(new MessageSent($character, $message));
    }
}
