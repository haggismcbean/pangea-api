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

use App\Jobs\Hunt;
use App\GameEvents\HuntEvent;

class HuntController extends Controller
{
    public static function hunt($character, $itemBoost) {
        $activity = $character->activity()->first();

        if (!$activity || $activity->type !== 'hunting') {
            return;
        }

        // roll for chances of success
        // TODO - skills
        $skillBoost = 1;
        $successChance = 1 * $skillBoost * $itemBoost;

        $roll = rand(0, 100);

        if ($roll < $successChance) {
            $isSuccess = true;
            CraftingController::completeActivity($character, $activity);

            $biome = $character->location()->first()->biome()->first();
            $animal = AnimalController::getDeadAnimal($biome, "herbivore");

            $meat = HuntController::getDeadAnimal($animal->id);

            if ($character->hasInventorySpace()) {
                $meatOwner = ItemOwnerController::getItemOwner('character', $character, $meat);
            } else {
                $zone = $character->zone()->first();
                $meatOwner = ItemOwnerController::getItemOwner('zone', $zone, $meat);
            }

            $meatOwner->count = $meatOwner->count + 1;
            $meatOwner->save();
        } else {
            $isSuccess = false;

            // REPEAT (todo - let users stop if they want!);
            HuntController::loopHuntJob($character, $itemBoost);
        }
        
        $huntEvent = new HuntEvent();
        $huntEvent->handle($character, $isSuccess);
    }

    private static function loopHuntJob($character, $itemBoost) {
        $job = new Hunt($character, $itemBoost);

        $job->dispatch($character, $itemBoost)
            ->delay(now()->addSeconds(10));

        return true;
    }

    private static function getDeadAnimal($animalId) {
        $animal = ItemController::getItem('animal', $animalId);

        if (!$animal) {
            return ItemController::createNewItem($animalId, 'meat', 'A lump of meat', 'animal');
        } else {
            return $animal;
        }
    }

    public function huntAnimal(Request $request) {
        $user = Auth::user();
        $character = $user->characters()->first();

        $itemUse = ItemUse::where('activity', 'hunting')->where('item_id', $request->itemId)->first();
        
        if (!$itemUse) {
            return response()->json("Can't hunt with that item", 400);
        }
        
        $efficiency = $itemUse->item()->first()->items()->first()->efficiency;

        $zone = $character->zone()->first();
        $activity = CraftingController::createActivity($zone, $character, null, "hunting");

        HuntController::hunt($character, $efficiency);

        return response()->json($activity, 200);
    }
}