<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Message;
use App\Events\MessageSent;

class WorkOnActivityEvent
{
    public function handle($character, $activity) {
        if (!$activity) {
            $message = $character->messages()->create([
                'message' => 'You finished activity ' . $activity->id,
                'source_type' => 'character',
                'source_name' => $character->name,
                'source_id' => $character->id,
            ]);
        } else {
            $message = $character->messages()->create([
                'message' => 'You worked on activity ' . $activity->id,
                'source_type' => 'character',
                'source_name' => $character->name,
                'source_id' => $character->id,
            ]);
        }

        broadcast(new MessageSent($character, $message));
    }
}
