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

use App\Jobs\Farm;
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

    public static function resolveActivity($character, $activity) {
        // plots with more plants take longer to clear
        $plantsCount = $character->biome()->first()->plants()->count();

        if ($plantsCount == 0) {
            $plantsCount = 1;
        }

        $activity->progress = $activity->progress + round((100 / $plantsCount), 0);
        $activity->save();

        if ($activity->progress >= 100) {
            FarmController::completeActivity($character, $activity);
        }
    }

    public static function completeActivity($character, $activity) {
        $recipe = $activity->recipe()->first();

        // createPlot
        if ($recipe->id === 0) {
            ZoneController::newZone($character, "Farm", "The scratched out beginnings of a farm");
        }

        $zone = $character->zone()->first();

        $activity->destroy($activity->id);
        $character->activity_id = null;
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

        $recipe = new stdClass();
        $recipe->id = 0;

        $activityController = new ActivityController;
        // TODO - add helpful tools. Can also be done by hand mind you.
        // $activityController->tools = $itemUse->item()->first()->items()->first();
        $activityController->workers = $character;

        $character->activity_id = $this->activity->id;
        $character->save();

        $activity = $activityController->createActivity($character, "farming", $recipe);

        $activityController->workOnActivity();

        return response()->json($activity, 200);
    }
}