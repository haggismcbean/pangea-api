<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\ActivityItem;

use App\Http\Controllers\ActivityItemController;
use App\Http\Controllers\PlantController;

use App\MadeItem;
use App\MadeItemRecipe;
use App\Plant;
use App\Mine;
use App\MineItem;

use Carbon\Carbon;

use App\GameEvents\ExplorationEvent;

class ExplorationController extends Controller
{
    public $mineRecipes = [
        "explore",
    ];

    public static function resolveActivity($activity, $character) {
        // TODO - progress increases at different rates for different jobs, duh!
        $activity->progress = $activity->progress + 100;
        $activity->save();

        if ($activity->progress >= 100) {
            return ExplorationController::completeActivity($character, $activity);
        }
    }

    public static function completeActivity($character, $activity) {
        // discover a thing, and create a 'mine' for it.
        $locationItemsCount = $character->location()->first()->locationItems()->count();

        // if (rand(0, 10) < 2 && $locationItemsCount > 0) {
            ExplorationController::completeCreateMine($character, $activity);
        // } else {
            // User just goes to wilderness and doesn't find anything useful.
            // ExplorationController::completeGoToWilderness($character, $activity);
        // }

        $activity->destroy($activity->id);
        $character->activity_id = null;

        return $character;
    }

    public static function completeCreateMine($character, $activity) {
        $zone = $character->zone()->first();

        // TODO - seed items per biome/location!
        // TODO - randomly choose one of the minerals
        $locationItems = $character->location()->first()->locationItems()->get();
        $locationItemsCount = $character->location()->first()->locationItems()->count();

        $locationItemIndex = rand(0, $locationItemsCount - 1);

        $locationItem = $locationItems[$locationItemIndex];

        $item = $locationItem->item();

        $mineZone = ZoneController::createZone($zone, $item->name . " Mine", "A natural deposit of " . $item->description);

        if (!$mineZone) {
            return;
        }

        $zone->size = $zone->size - 1;
        $zone->save();

        $character->zone_id = $mineZone->id;
        $character->save();

        $mine = new Mine;
        $mine->zone_id = $mineZone->id;
        $mine->layer = 'sedimentary';
        $mine->integrity = 10000;
        $mine->save();

        $location = $character->location()->first();

        $mineItem = new MineItem;
        $mineItem->mine_id = $mine->id;
        $mineItem->item_id = $locationItem->item_id;
        $mineItem->item_type = $locationItem->item_type;
        $mineItem->quantity = rand(0, $locationItem->quantity);

        $locationItem->quantity = $locationItem->quantity - $mineItem->quantity;

        $mineItem->save();
        $locationItem->save();
    }

    public static function sendMessage($activity, $result, $character) {
        $event = new ExplorationEvent;

        if ($activity->progress === 100) {
            $event->handle($character, $character->zone()->first()->description);
            return;
        }

        if ($result === 'SUCCESS') {
            $event->handle($character, true);
        } else {
            // TODO - handle death
            $event->handle($character, false);
        }
    }

    public function explore(Request $request) {
        // TODO = requires a pick of some sort
        $recipe = (object)[];
        $recipe->id = 0;
        $recipe->ingredients = [];

        return $this->doActivity($recipe);
    }

    public function doActivity($activityRecipe, $outputId=null, $outputType=null) {
        $user = Auth::user();
        $character = $user->characters()->first();

        $activityController = new ActivityController;
        // TODO - add helpful tools. Can also be done by hand mind you.
        // $activityController->tools = $itemUse->item()->first()->items()->first();
        $activityController->worker = $character;

        $activity = $activityController->createActivity($character, "exploring", $activityRecipe, $outputId, $outputType);

        $character->activity_id = $activity->id;
        $character->save();

        $this->goToWilderness($character, $activity);

        $activityController->workOnActivity();

        return response()->json($activity, 200);
    }

    public function goToWilderness($character, $activity) {
        // TODO - there should also be a chance to discover previously discovered zones!
        $zone = $character->zone()->first();
        $location = $character->location()->first();
        $character->zone_id = LocationController::getBaseZone($location)->id;
        $character->save();
    }
}