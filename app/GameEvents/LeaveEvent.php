<?php

namespace App\GameEvents;

use App\Activity;
use App\Character;
use App\Zone;
use App\Events\MessageSent;

class LeaveEvent
{
    public function handle($leavingCharacter, $zoneId, $activityId) {
        // okay so first, we find all the characters in the same location as this one!
        $activity = Activity::find($activityId);

        if ($activity && $activity->output_type == 'zone') {
            $destinationId = $activity->output_id;
        } else {
            // character has already arrived
            $destinationId = $leavingCharacter->zone_id;
        }

        $characters = Zone::find($zoneId)->characters()->get();

        foreach ($characters as $nearbyCharacter) {
            $message = $nearbyCharacter->messages()->create([
                'message' => $leavingCharacter->name . ' is leaving',
                'source_type' => 'character',
                'source_name' => $leavingCharacter->name,
                'source_id' => $leavingCharacter->id,
                'change' => 'zone',
                'change_id' => $destinationId
            ]);

            if ($nearbyCharacter->id !== $leavingCharacter->id) {
                broadcast(new MessageSent($nearbyCharacter, $message));
            }
        }
    }
}
