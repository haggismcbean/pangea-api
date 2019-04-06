<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Message;
use App\Events\MessageSent;

class WorkOnActivityEvent
{
    public function handle($character, $activity) {
        $message = $character->messages()->create([
            'message' => 'You worked on activity',
            'source_type' => 'character',
            'source_name' => $character->name,
            'source_id' => $character->id,
        ]);
        broadcast(new MessageSent($character, $message));
    }
}
