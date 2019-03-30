<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\ActivityItem;
use App\MadeItem;

use App\Jobs\AttackCharacter;

class ActivityController extends Controller
{
    public static function createActivity($zone, $character, $recipe) {
        $activity = new Activity;

        $activity->zone_id = $zone->id;
        $activity->character_id = $character->id;
        $activity->recipe_id = $recipe->id;

        $activity->progress = 0;

        $recipe->ingredients = $recipe->ingredients()->get();
        $activity->save();

        return $activity;
    }
}