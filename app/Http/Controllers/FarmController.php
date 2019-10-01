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
use App\Farm;

use Carbon\Carbon;

use App\GameEvents\FarmEvent;

/*
Things one can do to increase a yield
 - Plough field
 - Fertilizing
 - Irrigation
 - Till fields (ie. kill weeds)
 - 'Cultural control' Have beneficial animals/complimentary plants nearby??

Things one must do to farm
 - Sow seeds (unless tree/vine based, although then you do too but you have to wait bloody ages obv)
 - Wait for plant to mature
 - Harvest
*/

class FarmController extends Controller
{
    // TODO - cron job increasing yield of farms (or decreasing, if we get past the ideal time for that plant)
    public $farmRecipes = [
        "createPlot",
        "clearPlot",
        "plantPlot",
        "fertilizePlot",
        "tillPlot",
        "harvestPlot",
    ];

    public static function resolveActivity($activity, $character) {
        // plots with more plants take longer to clear
        $plantsCount = $character->location()->first()->biome()->first()->plants()->count();

        if ($plantsCount == 0) {
            $plantsCount = 1;
        }

        // $activity->progress = $activity->progress + round((100 / $plantsCount), 0);
        // TODO - progress increases at different rates for different jobs, duh!
        $activity->progress = $activity->progress + 20;
        $activity->save();

        if ($activity->progress >= 100) {
            return FarmController::completeActivity($character, $activity);
        }
    }

    public static function completeActivity($character, $activity) {
        $recipeId = $activity->recipe_id;

        // createPlot
        if ($recipeId === 0) {
            FarmController::completeCreatePlot($character, $activity);
        }

        // ploughPlot
        if ($recipeId === 1) {
            FarmController::completeClearPlot($character, $activity);
        }

        // plantPlot
        if ($recipeId === 2) {
            FarmController::completePlantPlot($character, $activity);
        }

        // fetilizePlot
        if ($recipeId === 3) {
            FarmController::completeFertilizePlot($character, $activity);
        }

        // fetilizePlot
        if ($recipeId === 4) {
            FarmController::completeTillPlot($character, $activity);
        }

        // harvestPlot
        if ($recipeId === 5) {
            FarmController::completeHarvestPlot($character, $activity);
        }

        $activity->destroy($activity->id);
        $character->activity_id = null;

        return $character;
    }

    public static function completeCreatePlot($character, $activity) {
        $zone = $character->zone()->first();
        $farmZone = ZoneController::createZone($zone, "Farm", "The scratched out beginnings of a farm", $character);

        if (!$farmZone) {
            return;
        }

        $character->zone_id = $farmZone->id;
        $character->save();

        $farm = new Farm;
        $farm->zone_id = $farmZone->id;
        $farm->current_yield = 0;

        $farm->save();
    }

    public static function completeClearPlot($character, $activity) {
        $farm = Farm::where('zone_id', $character->zone_id)->first();
        $farm->was_cleared_at = Carbon::now();
        $farm->cleared_score = 1;

        $farm->save();
    }

    public static function completePlantPlot($character, $activity) {
        $farm = Farm::where('zone_id', $character->zone_id)->first();
        $farm->was_planted_at = Carbon::now();

        $farm->save();
    }

    public static function completeFertilizePlot($character, $activity) {
        $farm = Farm::where('zone_id', $character->zone_id)->first();
        $farm->was_fertilized_at = Carbon::now();
        $farm->fertilized_score = $farm->fertilized_score + 1;
        $farm->current_yield = $farm->current_yield + 1;

        $farm->save();
    }

    public static function completeTillPlot($character, $activity) {
        $farm = Farm::where('zone_id', $character->zone_id)->first();
        $farm->was_tilled_at = Carbon::now();
        $farm->tilled_score = $farm->fertilized_score + 1;
        $farm->current_yield = $farm->current_yield + 1;

        $farm->save();
    }

    public static function completeHarvestPlot($character, $activity) {
        $farm = Farm::where('zone_id', $character->zone_id)->first();
        $location = $character->location()->first();

        // FIRST - create harvested plants for the user
        // TODO - harvest all parts
        $plant = FarmController::getPlant($farm->plant_id, 'leaf', $location);

        if (!$plant) {
            return response()->json(['message' => 'Cannot find plant or plant part'], 403);
        }

        $zone = $character->zone()->first();
        $plantOwner = ItemOwnerController::getItemOwner('zone', $zone, $plant);

        $plantOwner->count = $plantOwner->count + $farm->current_yield;
        $plantOwner->save();

        // THEN - reset 
        $farm->current_yield = 0;
        $farm->was_planted_at = null;
        $farm->plant_id = null;
        $farm->was_cleared_at = Carbon::now();
        $farm->cleared_score = 1;
        $farm->was_fertilized_at = null;
        $farm->fertilized_score = null;
        $farm->was_tilled_at = null;
        $farm->tilled_score = null;

        $farm->save();
    }

    public static function getPlant($plantId, $plantPiece, $location) {
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
        $user = Auth::user();
        $character = $user->characters()->first();
        $currentZone = $character->zone()->first();

        // Check we are not in a mine or a farm:
        if ($currentZone->mine()->first() || $currentZone->farm()->first()) {
            return response()->json(['message' => "Cannot create a farm in a mine or farm"], 400);
        }

        $recipe = (object)[];
        $recipe->id = 0;
        $recipe->ingredients = [];

        return $this->doActivity($recipe);
    }

    public function plough(Request $request) {
        // TODO = requires a plough of some sort
        $recipe = (object)[];
        $recipe->id = 1;
        $recipe->ingredients = [];

        return $this->doActivity($recipe);
    }

    public function plant(Request $request) {
        $user = Auth::user();
        $character = $user->characters()->first();
        // TODO = requires a hoe of some sort
        // TODO - validate farm is ploughed
        $recipe = (object)[];
        $recipe->id = 2;
        $recipe->ingredients = [];

        // TODO - remove seeds from the user
        $farm = Farm::where('zone_id', $character->zone_id)->first();
        $farm->plant_id = $request->plantId;
        $farm->current_yield = 1;
        $farm->save();

        return $this->doActivity($recipe);
    }

    public function fertilize(Request $request) {
        // TODO - validate farm is planted
        // TODO - validate farm is not fertilized already today
        $recipe = (object)[];
        $recipe->id = 3;
        $recipe->ingredients = [];

        // TODO - remove fertilizer from the user

        return $this->doActivity($recipe);
    }

    public function till(Request $request) {
        // TODO = requires a hoe of some sort
        // TODO - validate farm is planted
        // TODO - validate farm is not tilled already today
        $recipe = (object)[];
        $recipe->id = 4;
        $recipe->ingredients = [];

        return $this->doActivity($recipe);
    }

    public function harvest(Request $request) {
        // TODO = requires a hoe of some sort
        // TODO - validate farm is planted
        // TODO - validate farm is not tilled already today
        $recipe = (object)[];
        $recipe->id = 5;
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

        $activity = $activityController->createActivity($character, "farming", $activityRecipe);

        $character->activity_id = $activity->id;
        $character->save();

        $activityController->workOnActivity();

        return response()->json($activity, 200);
    }
}