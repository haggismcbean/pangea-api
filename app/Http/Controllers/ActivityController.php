<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\ActivityItem;

use App\Http\Controllers\ActivityItemController;

use App\MadeItem;
use App\MadeItemRecipe;

use App\Jobs\WorkOnActivity;
use App\GameEvents\WorkOnActivityEvent;

class ActivityController extends Controller
{
    public static function createActivity($zone, $character, $recipe, $type) {
        $activity = new Activity;

        $activity->zone_id = $zone->id;
        $activity->character_id = $character->id;

        $activity->progress = 0;

        if ($recipe) {
            $activity->type = 'crafting';
            $activity->recipe_id = $recipe->id;
            $recipe->ingredients = $recipe->ingredients()->get();
        } else {
            $activity->type = $type;
        }

        $activity->save();

        $character->activity_id = $activity->id;
        $character->save();

        return $activity;
    }

    public static function workActivity($character, $activity) {
        $activity->progress = $activity->progress + 1;
        $activity->save();

        if ($activity->type !== 'crafting') {
            throw Error(response()->json(['status' => 'None-crafting activity must be worked on using its specific method'], 403));
        }

        // recursion baby
        $workOnActivityEvent = new WorkOnActivityEvent($character, $activity);
        $workOnActivityEvent->handle($character, $activity);

        $job = new WorkOnActivity($character, $activity);
        $job->dispatch($character, $activity)
            ->delay(now()->addSeconds(1));
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

            // send item created message
            $workOnActivityEvent = new WorkOnActivityEvent();
            $workOnActivityEvent->handle($character, $activity);
        }

        $activity->destroy($activity->id);
        $character->activity_id = null;
    }

    public function createNewActivity(Request $request) {
        $user = Auth::user();

        $recipeId = $request->input('recipeId');

        $character = $user->characters->first();
        $zone = $character->zone()->first();
        $recipe = MadeItemRecipe::find($recipeId);

        // TODO - check if recipe requires any machines that are in current zone!

        // TODO - automatically add any ingredients the user is already carrying (which are added to the request)

        $activity = ActivityController::createActivity($zone, $character, $recipe);

        foreach ($recipe->ingredients as $key => $ingredient) {
            ActivityItemController::createActivityItem($activity, $ingredient);
        }

        return $activity;
    }

    public function addItemToActivity(Request $request) {
        $user = Auth::user();

        $character = $user->characters()->first();

        $activityId = $request->activityId;
        $itemId = $request->itemId;
        $amount = $request->amount;

        $characterItems = $character->itemOwners()->get();
        $activity = $character->zone()->first()->activities()->find($activityId);

        $item = Item::find($itemId);

        foreach ($characterItems as $characterItemKey => $characterItem) {

            if ($characterItem->item_id == $item->id) {
                // TODO - validation and remove the correct number of items.
                $characterItem->count = $characterItem->count - $amount;

                $ingredient = $activity->ingredients()->where('item_id', $item->id)->first();

                if (!$ingredient) {
                    $ingredient = $activity->ingredients()->where('item_type', $item->name)->first();
                }

                if (!$ingredient) {
                    return response()->json("Item could not be found in this activity", 400);
                }

                if ($ingredient->quantity_added == $ingredient->quantity_required) {
                    return response()->json("Item does not need more of that ingredient", 400);
                }

                $ingredient->quantity_added = $ingredient->quantity_added + 1;
                $ingredient->save();

                $characterItem->save();
            }
        }
    }

    public function createWorkOnActivityJob(Request $request) {
        $user = Auth::user();

        $character = $user->characters()->first();
        $activityId = $request->activityId;

        $activity = $character->zone()->first()->activities()->find($activityId);

        if (!$activity->isReadyForWork()) {
            return response()->json('Activity not ready for work', 400);
        }

        if ($activity) {
            $character->activity_id = $activity->id;
            $character->save();
        
            $job = new WorkOnActivity($character, $activity);
            $job->dispatch($character, $activity);

            return response()->json($activity, 200);
        } else {
            return response()->json('Activity could not be found', 400);
        }
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