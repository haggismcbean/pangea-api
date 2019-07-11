<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Zone;
use App\Plant;
use App\PlantName;

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemOwnerController;

class PlantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function name(Request $request) {
        $user = Auth::user();

        $character = $user->characters()->first();

        $plantId = $request->input('plantId');
        $plantName = $request->input('plantName');

        $plantName = new PlantName;

        $plantName->name = $plantName;
        $plantName->plant_id = $plantId;
        $plantName->character_id = $characterId;

        $plantName->save();
        return $plantName;
    }

    public function gather(Request $request) {
        $user = Auth::user();

        $plantId = $request->input('plantId');
        $plantPiece = $request->input('plantPiece');

        $character = $user->characters()->first();

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
            $plantOwner = ItemOwnerController::getItemOwner('character', $character, $plant);
        } else {
            $zone = $character->zone()->first();
            $plantOwner = ItemOwnerController::getItemOwner('zone', $zone, $plant);
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

            return ItemController::createNewItem($plantId, $plantPiece, $description, 'plant');
        } else {
            return $plant;
        }
    }
}