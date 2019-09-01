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
            'message' => 'You were attacked by ' . $attacker->getName($defender),
            'source_type' => 'character',
            'source_name' => $attacker->getName($defender),
            'source_id' => $attacker->id,
        ]);
        broadcast(new MessageSent($defender, $message));

        $message = $attacker->messages()->create([
            'message' => 'You attacked ' . $defender->getName($attacker),
            'source_type' => 'character',
            'source_name' => $attacker->getName($attacker),
            'source_id' => $attacker->id,
        ]);
        broadcast(new MessageSent($attacker, $message));

        $zone = $attacker->zone()->first();

        if ($zone->parent_zone) {
            $observers = $attacker->zone()->first()->characters()
                ->where('id', '!=', $attacker->id)
                ->where('id', '!=', $defender->id)
                ->get();
        } else {
            // wilderness
            $observers = $attacker->group()->first()->characters()
                ->where('id', '!=', $attacker->id)
                ->where('id', '!=', $defender->id)
                ->get();

            foreach ($observers as $observer) {
                $message = $observer->messages()->create([
                    'message' => $attacker->getName($observer) . ' attacked ' . $defender->getName($observer),
                    'source_type' => 'character',
                    'source_name' => $attacker->getName($observer),
                    'source_id' => $attacker->id,
                ]);
            }
        }
    }
}
