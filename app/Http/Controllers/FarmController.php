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
use App\GameEvents\HuntEvent;
// use App\GameEvents\FarmEvent;

class FarmController extends Controller
{
    public static function farm($character, $itemBoost, $plant) {
        $activity = $character->activity()->first();

        // TODO - check if user is logged in as well :P

        if (!$activity || $activity->type !== 'farming') {
            return;
        }

        // roll for chances of success
        // TODO - skills
        $skillBoost = 1;
        $successChance = 10000 * $skillBoost * $itemBoost;

        $roll = rand(0, 100);

        // TODO - below logic needs to be made... about farming :P
        if ($roll < $successChance) {
            $isSuccess = true;
            ActivityController::completeActivity($character, $activity);

            $crop = FarmController::getPlant($plant->id, 'seed', $character->location()->first());

            if ($character->hasInventorySpace()) {
                $cropOwner = ItemOwnerController::getItemOwner('character', $character, $crop);
            } else {
                $zone = $character->zone()->first();
                $cropOwner = ItemOwnerController::getItemOwner('zone', $zone, $crop);
            }

            $cropOwner->count = $cropOwner->count + 1;
            $cropOwner->save();
        } else {
            $isSuccess = false;

            // REPEAT (todo - let users stop if they want!);
            FarmController::loopFarmJob($character, $itemBoost, $plant);
        }
        
        // TODO - create a fancy custom farm event oooooooeooo
        $farmEvent = new HuntEvent();
        $farmEvent->handle($character, $isSuccess);
    }

    private static function loopFarmJob($character, $itemBoost, $plant) {
        $job = new Farm($character, $itemBoost, $plant);

        $job->dispatch($character, $itemBoost, $plant)
            ->delay(now()->addSeconds(10));

        return true;
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

        // $itemUse = ItemUse::where('activity', 'farming')->where('item_id', $request->itemId)->first();
        
        // if (!$itemUse) {
        //     return response()->json("Can't farm with that item", 400);
        // }
        
        $efficiency = 10;

        $zone = $character->zone()->first();

        // TODO - They will have seeds which they will plant! 
        // TODO - Needs to be a grass instead of a shrub?
        $plant = $character->location->first()->biome()->first()->plants()->where('typeName', 'shrub')->first();
        // END TODO

        $activity = ActivityController::createActivity($zone, $character, $plant, "farming");

        FarmController::farm($character, 100, $plant);

        return response()->json($activity, 200);
    }
}