<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WorldGenerator\PlantGenerator;

use App\Plant;
use App\Character;

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
        $plants = $location->plants()->find($plantId);

        // to do : actually reduce this in the database!!!!
        $locationPlant->count = $locationPlant->count - 1; 

        return $locationPlant;

        // $locationPlant = $this->getLocationPlant($location, $request->input('plantId'));

        // reduce locationPlant count by one
        // $locationPlant->count = $locationPlant->count - 1;
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