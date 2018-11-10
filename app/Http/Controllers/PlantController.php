<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemOwnerController;

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

            return $this->addPlantToNewOwner($plantId, $character, $location, $locationPlant);
        } else {
            return response()->json(['status' => 'No plants left'], 403);
        }
    }

    private function removePlantFromLocation($locationPlant) {
        $locationPlant->count = $locationPlant->count - 1;
        $locationPlant->save();
    }

    private function addPlantToNewOwner($plantId, $character, $location, $locationPlant) {
        $plant = $this->getPlant($plantId, $location);

        if ($character->hasInventorySpace()) {
            $plantOwner = $this->getPlantOwner('character', $character, $plant);
        } else {
            $zone = $character->zone()->first();
            $plantOwner = $this->getPlantOwner('zone', $zone, $plant);
        }
        
        $plantOwner->count = $plantOwner->count + 1;
        $plantOwner->save();

        return response()->json($plantOwner, 200);
    }

    private function getPlant($plantId, $location) {
        $plant = $location->getPlant($plantId);

        if (!$plant) {
            return ItemController::createNewItem($plantId);
        } else {
            return $plant;
        }
    }

    private function getPlantOwner($type, $owner, $plant) {
        $plantOwner = $owner->itemOwners()->first();

        if (!$plantOwner) {
            return ItemOwnerController::createNewItemOwner($type, $owner, $plant);
        } else {
            return $plantOwner;
        }
    }
}