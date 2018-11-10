<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemOwnerController;

use App\Plant;
use App\Character;
use App\Zone;
use App\LocationPlant;

class PlantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function gather(Request $request) {
        $plantId = $request->input('plantId');
        $character = CharacterController::getCharacter($request->input('characterId'));
        $location = $character->location()->first();
        $locationPlant = $location->getLocationPlant($plantId);

        if ($locationPlant && $locationPlant->count > 0) {
            $this->removePlantFromLocation($locationPlant);

            return $this->addPlantToNewOwner($plantId, $character, $locationPlant);
        } else {
            return response()->json(['status' => 'No plants left'], 403);
        }
    }

    private function removePlantFromLocation($locationPlant) {
        LocationPlant::where('id', $locationPlant->id)
            ->update(array('count' => $locationPlant->count - 1));
    }

    private function addPlantToNewOwner($plantId, $character, $locationPlant) {
        $item = $this->getItem($plantId);

        if ($character->hasInventorySpace()) {
            $itemOwner = $this->getItemOwner('character', $character, $item);
        } else {
            $zone = $character->zone()->first();
            $itemOwner = $this->getItemOwner('zone', $zone, $item);
        }
        
        $itemOwner->count = $itemOwner->count + 1;
        $itemOwner->save();

        return response()->json($itemOwner, 200);
    }

    private function getItem($plantId) {
        $item = ItemController::getItem('plant', $plantId);

        if (!$item) {
            return ItemController::createNewItem($plantId);
        } else {
            return $item;
        }
    }

    private function getItemOwner($type, $owner, $item) {
        $itemOwner = $owner->itemOwners()->first();

        if (!$itemOwner) {
            return ItemOwnerController::createNewItemOwner($type, $owner, $item);
        } else {
            return $itemOwner;
        }

    }
}