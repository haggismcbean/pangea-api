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
use App\Mine;

use Carbon\Carbon;

use App\GameEvents\FarmEvent;

class MiningController extends Controller
{
    public $mineRecipes = [
        "createMine",
        "mineMine",
        "reinforceMine",
    ];

    public static function resolveActivity($activity, $character) {
        // TODO - progress increases at different rates for different jobs, duh!
        $activity->progress = $activity->progress + 100;
        $activity->save();

        if ($activity->progress >= 100) {
            return MiningController::completeActivity($character, $activity);
        }
    }

    public static function completeActivity($character, $activity) {
        $recipeId = $activity->recipe_id;

        // createMine
        if ($recipeId === 0) {
            MiningController::completeCreateMine($character, $activity);
        }

        // mineMine
        if ($recipeId === 1) {
            MiningController::completeMineMine($character, $activity);
        }

        // reinforceMine
        if ($recipeId === 2) {
            MiningController::completeReinforceMine($character, $activity);
        }

        $activity->destroy($activity->id);
        $character->activity_id = null;

        return $character;
    }

    public static function completeCreateMine($character, $activity) {
        $zone = $character->zone()->first();
        $mineZone = ZoneController::createZone($zone, "Mine", "The scratched out beginnings of a mine");

        if (!$mineZone) {
            return;
        }

        $character->zone_id = $mineZone->id;
        $character->save();

        $mine = new Mine;
        $mine->zone_id = $mineZone->id;
        $mine->layer = 'sedimentary';
        $mine->integrity = 100;

        // TODO - populate MineItems table 
        
        $mine->save();
    }

    public static function completeMineMine($character, $activity) {
        $mine = Mine::where('zone_id', $character->zone_id)->first();

        // TODO - actually gather the material the user wants!
    }

    public static function completeReinforceMine($character, $activity) {
        $mine = Mine::where('zone_id', $character->zone_id)->first();
        if ($mine->integrity < 91) {
            $mine->integrity = $mine->integrity + 10;
        } else {
            $mine->integrity = 100;
        }

        $mine->save();
    }

    public static function sendMessage($activity, $result, $workers) {
        $event = new FarmEvent;

        if ($result === 'SUCCESS') {
            $event->handle($workers, true);
        } else {
            // TODO - handle death
            $event->handle($workers, false);
        }
    }

    public function create(Request $request) {
        // TODO = requires a pick of some sort
        $recipe = (object)[];
        $recipe->id = 0;
        $recipe->ingredients = [];

        return $this->doActivity($recipe);
    }

    public function mine(Request $request) {
        // TODO = requires a pick of some sort
        $recipe = (object)[];
        $recipe->id = 1;
        $recipe->ingredients = [];

        return $this->doActivity($recipe);
    }

    public function reinforce(Request $request) {
        // TODO = requires some planks of wood and building stuff of some sort
        $recipe = (object)[];
        $recipe->id = 2;
        $recipe->ingredients = [];

        return $this->doActivity($recipe);
    }

    public function doActivity($activityRecipe) {
        $user = Auth::user();
        $character = $user->characters()->first();

        $activityController = new ActivityController;
        // TODO - add helpful tools. Can also be done by hand mind you.
        // $activityController->tools = $itemUse->item()->first()->items()->first();
        $activityController->worker = $character;

        $activity = $activityController->createActivity($character, "mining", $activityRecipe);

        $character->activity_id = $activity->id;
        $character->save();

        $activityController->workOnActivity();

        return response()->json($activity, 200);
    }
}