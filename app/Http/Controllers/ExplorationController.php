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
use App\Group;
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
        $locationItemsCount = $character->location()->first()->locationItems()->where('item_type', '!=', 'stone')->count();

        $randomNumber = rand(0, 10);

        // if ($randomNumber < 2 && $locationItemsCount > 0) {
            // ExplorationController::completeCreateMine($character, $activity);
        // } else if ($randomNumber < 4) {
            ExplorationController::completeFindPerson($character, $activity);
        // }

        $activity->destroy($activity->id);
        $character->activity_id = null;

        return $character;
    }

    public static function completeCreateMine($character, $activity) {
        $activity->output_type = 'zone';
        $activity->save();

        $zone = $character->zone()->first();

        // TODO - seed items per biome/location!
        // TODO - randomly choose one of the minerals
        $locationItems = $character->location()->first()->locationItems()->where('item_type', '!=', 'stone')->get();

        if (!$locationItems) {
            return response()->json("No remaining resources in this location", 400);
        }

        $locationItem = ExplorationController::getRandomLocationItem($locationItems);

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

        if ($locationItem->quantity > 100) {
            $mineItem->quantity = rand(100, $locationItem->quantity);
        } else {
            $mineItem->quantity = $locationItem->quantity;
        }

        $locationItem->quantity = $locationItem->quantity - $mineItem->quantity;

        if ($locationItem->quantitiy < 1) {
            $locationItem->delete();
        }

        $mineItem->save();
        $locationItem->save();
    }

    public static function completeFindPerson($character, $activity) {
        $activity->output_type = 'group';
        $activity->save();

        $personCount = $character->zone()->first()->characters()->where('id', '!=', $character->id)->count();
        $people = $character->zone()->first()->characters()->where('id', '!=', $character->id)->get();

        $randomPerson = $people[rand(0, $personCount - 1)];

        if (!$randomPerson->group_id) {
            $group = new Group;
            $group->save();

            $randomPerson->group_id = $group->id;
            $randomPerson->save();
        } else {
            $group = $randomPerson->group()->first();
        }

        $character->group_id = $group->id;
        $character->save();

        // TODO - we need to broadcast to the front end (to both users) to join the group!
    }

    private static function getRandomLocationItem($locationItems) {
        // So we only get items that are minerals.
        $locationItemsCount = $locationItems->count();
        $locationItemIndex = rand(0, $locationItemsCount - 1);

        return $locationItems[$locationItemIndex];
    }

    public static function sendMessage($activity, $result, $character) {
        $event = new ExplorationEvent;

        // New zone discovered
        if ($activity->progress === 100 && $activity->output_type === 'zone') {
            $zone = $character->zone()->first();
            $event->handle($character, $zone->description, 'zone', $zone->id);
            return;
        }

        // New group joined
        if ($activity->progress === 100 && $activity->output_type === 'group') {
            $group = $character->group()->first();
            $groupCount = $group->characters()->count() - 1;
            $event->handle($character, 'A group of size ' . $groupCount, 'group', $group->id);
            return;
        }

        // Activity not finished message
        if ($result === 'SUCCESS' || $result === 'FAILURE') {
            $event->handle($character, $result, null, null);
            return;
        }
    }

    public function explore(Request $request) {
        $user = Auth::user();
        $character = $user->characters()->first();
        $zone = $character->zone()->first();

        if ($zone->parent_zone) {
            return response()->json("Can only explore in wilderness", 400);
        }

        if ($zone->size < 2) {
            return response()->json("This location is fully explored", 400);
        }

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