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
        $newName = $request->input('name');

        return $this->namePlant($newName, $plantId, $character->id);
    }

    private function namePlant($newName, $plantId, $characterId) {

        $plantName = PlantName::where('character_id', $characterId)
            ->where('plant_id', $plantId)
            ->first();

        if (!$plantName) {
            $plantName = new PlantName;

            $plantName->plant_id = $plantId;
            $plantName->character_id = $characterId;
        }

        $plantName->plant_name = $newName;
        $plantName->save();

        return $plantName;
    }

    public function gather(Request $request) {
        $user = Auth::user();

        $plantId = $request->input('plantId');
        $plantPiece = $request->input('plantPiece');
        $amount = $request->input('amount');

        $character = $user->characters()->first();

        $location = $character->location()->first();

        $locationPlant = $location->getLocationPlant($plantId);

        if ($locationPlant && $locationPlant->isAvailable($amount, $plantPiece)) {
            $this->removePlantFromLocation($plantPiece, $locationPlant, $amount);

            return $this->addPlantToNewOwner($plantId, $character, $locationPlant, $location, $plantPiece, $amount);
        } else {
            return response()->json(['message' => 'Not enough plants left'], 403);
        }
    }

    public function share(Request $request) {
        $user = Auth::user();
        $activeCharacter = $user->characters()->first();

        $plantId = $request->input('plantId');
        $characterId = $request->input('characterId');

        $newName = Plant::find($plantId)->getName($activeCharacter);

        return $this->namePlant($newName, $plantId, $characterId);
    }

    private function removePlantFromLocation($plantPiece, $locationPlant, $amount) {
        $plant = $locationPlant->plant()->first();

        if ($plantPiece === 'fruit') {
            $locationPlant->fruit_gathered_today += $amount * $plant->yield_per_item;
        }

        if ($plantPiece === 'flower') {
            $locationPlant->flower_gathered_today += $amount * $plant->yield_per_item;
        }

        if ($plantPiece === 'seed') {
            $locationPlant->seed_gathered_today += $amount * $plant->yield_per_item;
        }

        if ($plantPiece === 'leaf') {
            $locationPlant->leaf_gathered_today += $amount * $plant->yield_per_item;
        }

        if ($plantPiece === 'stalk') {
            $locationPlant->stalk_gathered_today += $amount * $plant->yield_per_item;
        }

        if ($plantPiece === 'root') {
            $locationPlant->root_gathered_today += $amount * $plant->yield_per_item;
        }

        if ($plantPiece === 'wood' && $amount > 9) {
            $locationPlant->count = $locationPlant->count - 1;
        }

        $locationPlant->save();
    }

    private function addPlantToNewOwner($plantId, $character, $locationPlant, $location, $plantPiece, $amount) {
        $plant = $this->getPlant($plantId, $plantPiece, $location);

        if (!$plant) {
            return response()->json(['message' => 'Cannot find plant or plant part'], 403);
        }

        if ($character->hasInventorySpace()) {
            $plantOwner = ItemOwnerController::getItemOwner('character', $character, $plant);
        } else {
            $zone = $character->zone()->first();
            $plantOwner = ItemOwnerController::getItemOwner('zone', $zone, $plant);
        }

        $plantOwner->count = $plantOwner->count + $amount;
        $plantOwner->save();

        return response()->json($plantOwner, 200);
    }

    private function getPlant($plantId, $plantPiece, $location) {
        // TODO - make this an activity
        $plant = ItemController::getItem('plant', $plantId, $plantPiece);

        if (!$plant) {
            $descriptionKey = $plantPiece . 'Appearance';
            $description = $location->plants()->find($plantId)->$descriptionKey;
            $efficiency = $location->plants()->find($plantId)->yield_per_item;

            if (!$description) {
                return;
            }

            return ItemController::createNewItem($plantId, $plantPiece, $description, 'plant', $efficiency);
        } else {
            return $plant;
        }
    }
}