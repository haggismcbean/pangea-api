<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Message;
use App\Events\MessageSent;

use App\WorldGenerator\FarmMessageGenerator;

class FarmEvent
{
    public function handle($character, $isSuccess) {
        if (!$isSuccess) {
            $message = $character->messages()->create([
                'message' => FarmMessageGenerator::getFailureMessage(),
                'source_type' => 'character',
                'source_name' => $character->getName($character),
                'source_id' => $character->id,
            ]);
        } else {
            $message = $character->messages()->create([
                'message' => FarmMessageGenerator::getSuccessMessage(),
                'source_type' => 'character',
                'source_name' => $character->getName($character),
                'source_id' => $character->id,
            ]);
        }

        broadcast(new MessageSent($character, $message));
    }
}
