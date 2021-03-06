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
    public static function resolveActivity($activity, $character) {
        $activity->progress = 100;
        $activity->save();

        $character->activity_id = null;
        $character->save();

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
    }

    private static function getDeadAnimal($animalId) {
        $animal = ItemController::getItem('animal', $animalId);

        if (!$animal) {
            return ItemController::createNewItem($animalId, 'meat', 'A lump of meat', 'animal');
        } else {
            return $animal;
        }
    }

    public static function sendMessage($activity, $result, $workers) {
        $event = new HuntEvent;

        if ($result === 'SUCCESS') {
            $event->handle($workers, true);
        } else {
            // TODO - handle death
            $event->handle($workers, false);
        }
    }

    public function huntAnimal(Request $request) {
        $user = Auth::user();
        $character = $user->characters()->first();

        // TODO - get item from user rather than use a bow every time
        $itemUse = ItemUse::where('activity', 'hunting')->where('item_id', $request->itemId)->first();
        
        if (!$itemUse) {
            return response()->json(['message' => "Can't hunt with that item"], 400);
        }

        $activityController = new ActivityController;
        $activityController->tools = $itemUse->item()->first()->items()->first();
        $activityController->worker = $character;

        $activity = $activityController->createActivity($character, "hunting");

        $character->activity_id = $activity->id;
        $character->save();

        $activityController->workOnActivity();

        return response()->json($activity, 200);
    }
}