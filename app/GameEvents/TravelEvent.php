<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Message;
use App\Events\MessageSent;

use App\WorldGenerator\TravelMessageGenerator;

class TravelEvent
{
    public function handle($character, $isSuccess) {
        if (!$isSuccess) {
            $message = $character->messages()->create([
                'message' => TravelMessageGenerator::getFailureMessage(),
                'source_type' => 'character',
                'source_name' => $character->name,
                'source_id' => $character->id,
                'change' => 'zone',
                'change_id' => $character->zone_id
            ]);
        } else {
            $message = $character->messages()->create([
                'message' => TravelMessageGenerator::getSuccessMessage($character->zone()->first()),
                'source_type' => 'character',
                'source_name' => $character->name,
                'source_id' => $character->id,
                'change' => 'zone',
                'change_id' => $character->zone_id
            ]);
        }

        broadcast(new MessageSent($character, $message));
    }
}
