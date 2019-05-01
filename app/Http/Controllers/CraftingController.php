<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\ActivityItem;

use App\Item;
use App\MadeItem;
use App\MadeItemRecipe;

use App\Jobs\WorkOnActivity;
use App\GameEvents\WorkOnActivityEvent;

class CraftingController extends Controller
{
    public static function resolveActivity($activity, $character) {
        $activity->progress = $activity->progress + 10;
        $activity->save();

        if ($activity->progress === 100) {
            CraftingController::completeActivity($character, $activity);
        }
    }

    public static function completeActivity($character, $activity) {
        $recipe = $activity->recipe()->first();

        if ($recipe) {
            $itemType = $activity->recipe()->first()->item()->first();
            $item = ItemController::getItem('made_item', $itemType->id);

            if ($character->hasInventorySpace()) {
                $itemOwner = ItemOwnerController::getItemOwner('character', $character, $item);
            } else {
                $zone = $character->zone()->first();
                $itemOwner = ItemOwnerController::getItemOwner('zone', $zone, $item);
            }

            $itemOwner->count = $itemOwner->count + 1;
            $itemOwner->save();
        }

        $activity->destroy($activity->id);
        $character->activity_id = null;
    }

    public static function sendMessage($activity, $result, $character) {
        $workOnActivityEvent = new WorkOnActivityEvent;
        $workOnActivityEvent->handle($character, $activity);
    }

    public function createNewActivity(Request $request) {
        $user = Auth::user();

        $recipeId = $request->input('recipeId');

        $character = $user->characters->first();
        $recipe = MadeItemRecipe::find($recipeId);

        // TODO - check if recipe requires any machines that are in current zone!

        // TODO - automatically add any ingredients the user is already carrying (which are added to the request)

        $activity = ActivityController::createActivity($character, 'crafting', $recipe);

        return $activity;
    }

    public function addItemToActivity(Request $request) {
        $user = Auth::user();

        $character = $user->characters()->first();

        $activityId = $request->activityId;
        $itemId = $request->itemId;
        $amount = $request->amount;

        $activity = $character->zone()->first()->activities()->find($activityId);

        $item = Item::find($itemId);

        $activityController = new ActivityController($activity);
        $activityController->addIngredientsToActivity($character, $item, $amount);
    }

    public function workOnActivity(Request $request) {
        $user = Auth::user();

        $character = $user->characters()->first();
        $activityId = $request->activityId;

        $activity = $character->zone()->first()->activities()->find($activityId);

        if (!$activity) {
            return response()->json("Activity not found", 400);
        }

        $character->activity_id = $activity->id;
        $character->save();

        // DEV (remove for live!)
        $activity->type = "crafting";
        $activity->save();
        // END DEV

        $activityController = new ActivityController($activity);
        $activityController->worker = $character;
        $activityController->workOnActivity();
    }

    public function stopWorkingOnActivity(Request $request) {
        $user = Auth::user();

        $character = $user->characters()->first();
        $character->activity_id = null;
        $character->save();
            
        return response()->json($character, 200);
    }

    public function cancelActivity(Request $request) {
        $user = Auth::user();

        $character = $user->characters()->first();

        $activity = $character->activity()->first();
        $activity->destroy($activity->id);

        return $this->stopWorkingOnActivity($request);
    }
}