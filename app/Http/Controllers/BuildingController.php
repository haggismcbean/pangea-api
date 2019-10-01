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
use App\MineItem;

use Carbon\Carbon;

use App\GameEvents\FarmEvent;

class BuildingController extends Controller
{
    public static function resolveActivity($activity, $character) {
        // TODO - progress increases at different rates for different jobs, duh!
        $activity->progress = $activity->progress + 100;
        $activity->save();

        if ($activity->progress >= 100) {
            return SmeltingController::completeActivity($character, $activity);
        }
    }

    public static function completeActivity($character, $activity) {
        $recipeId = $activity->recipe_id;

        // breakRocks
        if ($recipeId === 0) {
            SmeltingController::completeBreakRocks($character, $activity);
        }

        $activity->destroy($activity->id);
        $character->activity_id = null;

        return $character;
    }

    public static function completeExpandZone($character, $activity) {
        $baseZone = LocationController::getBaseZone($location)->id;

        if ($baseZone->size > 1) {
            $baseZone->size = $baseZone->size - 1;
            $baseZone->save();

            $zone = $character->zone()->first();

            $zone->size = $zone->size + 1;
            $zone->save();
        }
    }

    public static function completeBuildWalls($character, $activity) {
        $zone = $character->zone()->first();

        // TODO
        $zone->wall_id = $activity->output_id;
        $zone->save();
    }

    public static function completeBuildDoor($character, $activity) {
        $zone = $character->zone()->first();
        $zone->door_id = $activity->output_id;
        $zone->save();
    }

    public static function completeBuildBuilding($character, $activity) {
        $zone = $character->zone()->first();

        // if base zone doesn't have a zone, i guess we need to make one!
        if (!$zone->parent_zone) {
            $zone = ZoneController::createZone($zone, "Clearing", "A small clearing", $character);
            $zone->size = 2;
            $zone->save();

            $character->zone_id = $zone->id;
            $character->save();
        }

        // sub zones can have a size of zero.
        if ($zone->size > 1) {
            // TODO - building description
            $buildingZone = ZoneController::createZone($zone, "Building", "A simple dwelling", $character);
        }
    }

    public function expandZone(Request $request) {
        // increases the zone size so you can build more things inside it? 
        // like farms, mines, houses
        // I guess a zone without any kind of wall or marking can expand pretty quickly... ? Except maybe you need to clear land. Yeah. That's what you have to do. Cool.

        $recipe = (object)[];
        $recipe->id = 0;
        $recipe->ingredients = [];

        return $this->doActivity($recipe);
    }

    public function buildWalls(Request $request) {
        // walls the zone so people can be seen/prevented from coming in
        // depending on wall quality
        
        $recipe = (object)[];
        $recipe->id = 1;
        $recipe->ingredients = [];

        return $this->doActivity($recipe);
    }

    public function buildDoor(Request $request) {
        // walls/buildings start with a gap. this can be made a door to make it significantly harder to enter
        
        $recipe = (object)[];
        $recipe->id = 2;
        $recipe->ingredients = [];

        return $this->doActivity($recipe);
    }

    public function buildBuilding(Request $request) {
        // adds a building to an outside, or adds another room to an existing building.

        $recipe = (object)[];
        $recipe->id = 3;
        $recipe->ingredients = [];
    }

    public function doActivity($activityRecipe, $outputId=null, $outputType=null) {
        $user = Auth::user();
        $character = $user->characters()->first();

        $activityController = new ActivityController;

        // TODO - can only be accomplished with machines and tools
        // $activityController->tools = $itemUse->item()->first()->items()->first();
        $activityController->worker = $character;

        // TODO - different recipes produce different metals. This can be calculated on input

        $activity = $activityController->createActivity($character, "building", $activityRecipe, $outputId, $outputType);

        $character->activity_id = $activity->id;
        $character->save();

        $activityController->workOnActivity();

        return response()->json($activity, 200);
    }
}