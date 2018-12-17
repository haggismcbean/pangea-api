<?php

namespace App\GameEvents;

use App\Character;
use App\Location;
use App\Message;
use App\Events\MessageSent;

class AttackCharacterEvent
{
    public function handle($attacker, $defender) {
        $message = $defender->messages()->create([
            'message' => 'You were attacked by ' . $attacker->name,
            'source_type' => 'character',
            'source_name' => $attacker->name,
            'source_id' => $attacker->id,
        ]);
        broadcast(new MessageSent($defender, $message));

        $message = $attacker->messages()->create([
            'message' => 'You attacked ' . $defender->name,
            'source_type' => 'character',
            'source_name' => $attacker->name,
            'source_id' => $attacker->id,
        ]);
        broadcast(new MessageSent($attacker, $message));
    }
}
