<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Message;
use App\Events\MessageSent;

class HuntEvent
{
    public function handle($character, $item, $isSuccess) {
        if (!$isSuccess) {
            $message = $character->messages()->create([
                'message' => 'You sat quietly but nothing happened',
                'source_type' => 'character',
                'source_name' => $character->name,
                'source_id' => $character->id,
            ]);
        } else {
            $message = $character->messages()->create([
                'message' => 'A deer crept into view, nervously browsing on the grasses nearby. You stayed still until it was very close, then you launched a projectile. You hit your target. The deer ran away, but it left a trail of blood. Following the trail, you find the deer lying gasping for air a short distance away. You finish it off.',
                'source_type' => 'character',
                'source_name' => $character->name,
                'source_id' => $character->id,
            ]);
        }

        broadcast(new MessageSent($character, $message));
    }
}
