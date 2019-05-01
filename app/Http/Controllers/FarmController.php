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
    public $farmRecipes = [
        "createPlot"
    ];

    public static function resolveActivity($activity, $character) {
        // plots with more plants take longer to clear
        $plantsCount = $character->location()->first()->biome()->first()->plants()->count();

        if ($plantsCount == 0) {
            $plantsCount = 1;
        }

        // $activity->progress = $activity->progress + round((100 / $plantsCount), 0);
        $activity->progress = $activity->progress + 10;
        $activity->save();

        if ($activity->progress >= 100) {
            return FarmController::completeActivity($character, $activity);
        }
    }

    public static function completeActivity($character, $activity) {
        $recipeId = $activity->recipe_id;

        // createPlot
        if ($recipeId === 0) {
            $zone = $character->zone()->first();
            $farmZone = ZoneController::createZone($zone, "Farm", "The scratched out beginnings of a farm");

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

        $activity->destroy($activity->id);
        $character->activity_id = null;

        return $character;
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

    public function createPlot(Request $request) {
        $user = Auth::user();
        $character = $user->characters()->first();

        $recipe = (object)[];
        $recipe->id = 0;
        $recipe->ingredients = [];

        $activityController = new ActivityController;
        // TODO - add helpful tools. Can also be done by hand mind you.
        // $activityController->tools = $itemUse->item()->first()->items()->first();
        $activityController->worker = $character;

        $activity = $activityController->createActivity($character, "farming", $recipe);

        $character->activity_id = $activity->id;
        $character->save();

        $activityController->workOnActivity();

        return response()->json($activity, 200);
    }
}