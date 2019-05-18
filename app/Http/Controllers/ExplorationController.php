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

use App\GameEvents\FarmEvent;

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
        ExplorationController::completeCreateMine($character, $activity);

        $activity->destroy($activity->id);
        $character->activity_id = null;

        return $character;
    }

    public static function completeCreateMine($character, $activity) {
        $zone = $character->zone()->first();

        // TODO - seed items per biome/location!
        // TODO - randomly choose one of the minerals
        $locationItems = $character->location()->first()->locationItems()->where('item_type', 'mineral')->get();
        $locationItemsCount = $character->location()->first()->locationItems()->where('item_type', 'mineral')->count();

        $locationItemIndex = rand(0, $locationItemsCount);

        $locationItem = $locationItems[$locationItemIndex];

        $mineZone = ZoneController::createZone($zone, $itemType . " Mine", "A natural deposit of " . $locationItem);

        if (!$mineZone) {
            return;
        }

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

    public static function sendMessage($activity, $result, $workers) {
        $event = new FarmEvent;

        if ($result === 'SUCCESS') {
            $event->handle($workers, true);
        } else {
            // TODO - handle death
            $event->handle($workers, false);
        }
    }

    public function create(Request $request) {
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

        $activityController->workOnActivity();

        return response()->json($activity, 200);
    }
}