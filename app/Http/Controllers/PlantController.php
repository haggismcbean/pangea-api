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
        $plantPiece = $request->input('plantPiece');

        $character = CharacterController::getCharacter($request->input('characterId'));
        $location = $character->location()->first();
        $locationPlant = $location->getLocationPlant($plantId);

        if ($locationPlant && $locationPlant->count > 0) {
            $this->removePlantFromLocation($locationPlant);

            return $this->addPlantToNewOwner($plantId, $character, $locationPlant, $location, $plantPiece);
        } else {
            return response()->json(['status' => 'No plants left'], 403);
        }
    }

    private function removePlantFromLocation($locationPlant) {
        $locationPlant->count = $locationPlant->count - 1;
        $locationPlant->save();
    }

    private function addPlantToNewOwner($plantId, $character, $locationPlant, $location, $plantPiece) {
        $plant = $this->getPlant($plantId, $plantPiece, $location);

        if (!$plant) {
            return response()->json(['status' => 'Cannot find plant or plant part'], 403);
        }

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

    private function getPlant($plantId, $plantPiece, $location) {
        $plant = ItemController::getItem('plant', $plantId, $plantPiece);

        if (!$plant) {
            $descriptionKey = $plantPiece . 'Appearance';
            $description = $location->plants()->find($plantId)->$descriptionKey;

            if (!$description) {
                return;
            }

            return ItemController::createNewItem($plantId, $plantPiece, $description);
        } else {
            return $plant;
        }
    }

    private function getPlantOwner($type, $owner, $plant) {
        $plantOwners = $owner->itemOwners()->get();
        $plantOwner = null;

        foreach ($plantOwners as $currentPlantOwner) {
            if ($currentPlantOwner->item()->first()->name == $plant->name) {
                $plantOwner = $currentPlantOwner;
            }
        }

        if (!$plantOwner) {
            return ItemOwnerController::createNewItemOwner($type, $owner, $plant);
        } else {
            return $plantOwner;
        }
    }
}