<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WorldGenerator\PlantGenerator;

use App\Plant;
use App\Character;
use App\LocationPlant;

class PlantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function gather(Request $request) {
        $plantId = $request->input('plantId');
        $character = $this->getCharacter($request->input('characterId'));
        $location = $character->location()->first();
        $locationPlant = $location->locationPlants()->where('plant_id', $plantId)->get()[0];

        if ($locationPlant->count > 0) {
            LocationPlant::where('id', $locationPlant->id)->update(array('count' => $locationPlant->count - 1));
            // to do - move plant into the player's inventory! Unless it's too large, then it just goes on the floor.
            return $location->plants()->find($plantId);
        } else {
            return response()->json(['status' => 'No plants left'], 403);
        }
    }

    private function getCharacter($characterId) {
        $user = Auth::user();
        $characterId = $characterId;

        $character = $user->characters()->find($characterId);

        if ($character) {
            return $character;
        } else {
            return null;
        }
    }

    private function getLocationPlant($location, $plantId) {
        $plant = $location->locationPlants()->find($plantId);

        if ($plant) {
            return $plant;
        } else {
            return null;
        }

    }
}