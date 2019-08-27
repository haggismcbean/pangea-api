<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\ActivityItem;

use App\Http\Controllers\ActivityItemController;
use App\Http\Controllers\AnimalController;

use App\ItemUse;
use App\MadeItem;
use App\MadeItemRecipe;

use App\Jobs\Travel;
use App\GameEvents\TravelEvent;

class TravelController extends Controller
{
    public static function resolveActivity($activity, $character) {
        $activity->progress = 100;
        $activity->save();

        $character->activity_id = null;
        $character->zone_id = $activity->output_id;
        $character->group_id = null;
        $character->save();
    }

    public static function sendMessage($activity, $result, $workers) {
        $event = new TravelEvent;

        if ($result === 'SUCCESS') {
            $event->handle($workers, true);
        } else {
            // TODO - handle death
            $event->handle($workers, false);
        }
    }

    public function changeZones($zone) {
        $user = Auth::user();
        $character = $user->characters()->first();

        $activityController = new ActivityController;
        $activityController->worker = $character;

        $activity = $activityController->createActivity($character, "travelling", null, $zone->id, 'zone');

        $character->activity_id = $activity->id;
        $character->group_id = null;
        $character->save();

        $activityController->workOnActivity();

        return response()->json($activity, 200);
    }
}