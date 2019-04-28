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

use App\Jobs\Farm;
use App\GameEvents\FarmEvent;

/*
Things one can do to increase a yield
 - Plough field
 - Fertilizing
 - Irrigation
 - Till fields (ie. kill weeds)
 - 'Cultural control' Have beneficial animals/complimentary plants nearby??

Things one must do to farm
 - Sow seeds (unless tree/vine based, although then you do too but you have to wait bloody ages obv)
 - Wait for plant to mature
 - Harvest
*/

class FarmController extends Controller
{
    public static function resolveActivity($character, $activity) {
        $activity->progress = 100;
        $activity->save();

        $character->activity_id = null;
        $character->save();

        CraftingController::completeActivity($character, $activity);

        $crop = FarmController::getPlant($plant->id, 'seed', $character->location()->first());

        if ($character->hasInventorySpace()) {
            $cropOwner = ItemOwnerController::getItemOwner('character', $character, $crop);
        } else {
            $zone = $character->zone()->first();
            $cropOwner = ItemOwnerController::getItemOwner('zone', $zone, $crop);
        }

        $cropOwner->count = $cropOwner->count + 1;
        $cropOwner->save();
    }

    public static function sendMessage($activity, $result, $worker) {
        $event = new FarmEvent;

        if ($result === 'SUCCESS') {
            $event->handle($worker, true);
        } else {
            // TODO - handle death
            $event->handle($worker, false);
        }
    }

    private static function getPlant($plantId, $plantPiece, $location) {
        $plant = ItemController::getItem('plant', $plantId, $plantPiece);

        if (!$plant) {
            $descriptionKey = $plantPiece . 'Appearance';
            $description = $location->plants()->find($plantId)->$descriptionKey;

            if (!$description) {
                return;
            }

            return ItemController::createNewItem($plantId, $plantPiece, $description, 'plant');
        } else {
            return $plant;
        }
    }

    public function farmCrop(Request $request) {
        $user = Auth::user();
        $character = $user->characters()->first();

        // TODO - They will have seeds which they will plant! 
        // TODO - Needs to be a grass instead of a shrub?
        $plant = $character->location->first()->biome()->first()->plants()->where('typeName', 'shrub')->first();
        // END TODO

        // $activity = ActivityController::createActivity($character, "farming");

        // $activityController->workOnActivity();

        return response()->json($activity, 200);
    }
}