<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Message;
use App\Events\MessageSent;

use App\WorldGenerator\TravelMessageGenerator;

class ArriveEvent
{
    public function handle($character, $isSuccess) {
        if (!$isSuccess) {
            $message = $character->messages()->create([
                'message' => TravelMessageGenerator::getFailureMessage(),
                'source_type' => 'character',
                'source_name' => $character->getName($character),
                'source_id' => $character->id,
                'change' => 'zone',
                'change_id' => $character->zone_id
            ]);
        } else {
            $message = $character->messages()->create([
                'message' => TravelMessageGenerator::getSuccessMessage($character->zone()->first()),
                'source_type' => 'character',
                'source_name' => $character->getName($character),
                'source_id' => $character->id,
                'change' => 'zone',
                'change_id' => $character->zone_id
            ]);
        }

        broadcast(new MessageSent($character, $message));

        // notify people in new zone
        $newZone = $character->zone()->first();
        if ($newZone->parent_zone) {
            $neighbours = $newZone->characters()->get();

            foreach ($neighbours as $neighbour) {
                if ($neighbour->id != $character->id) {
                    $message = $character->messages()->create([
                        'message' => $character->getName($neighbour) . ' has arrived',
                        'source_type' => 'character',
                        'source_name' => $character->getName($neighbour),
                        'source_id' => $character->id
                    ]);

                    broadcast(new MessageSent($neighbour, $message));
                }
            }
        }
    }
}
