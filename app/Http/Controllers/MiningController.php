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

class MiningController extends Controller
{
    public $mineRecipes = [
        "createMine",
        "mineMine",
        "reinforceMine",
    ];

    private $stoneLayers = [
        "sedimentary",
        "igneous extrusive",
        "metamorphic",
        "igneous intrusive"
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
        $mine->save();

        $location = $character->location()->first();
        $locationItems = $location->locationItems()->get();

        foreach ($locationItems as $locationItem) {
            if ($locationItem->item_type === 'stone') {
                $mineItem = new MineItem;
                $mineItem->mine_id = $mine->id;
                $mineItem->item_id = $locationItem->item_id;
                $mineItem->item_type = $locationItem->item_type;
                $mineItem->quantity = rand(0, $locationItem->quantity);

                $locationItem->quantity = $locationItem->quantity - $mineItem->quantity;

                $mineItem->save();
                $locationItem->save();
            }
        }
    }

    public static function completeMineMine($character, $activity) {
        $mine = Mine::where('zone_id', $character->zone_id)->first();

        $mineItem = $mine->items()
            ->where('item_type', $activity->output_type)
            ->where('item_id', $activity->output_id)
            ->first();
        $mineItem->quantity = $mineItem->quantity - 1;
        $mineItem->save();

        $zone = $character->zone()->first();
        $itemOwner = ItemOwnerController::getItemOwner('zone', $zone, $mineItem);
        $itemOwner->count = $itemOwner->count + 1;
        $itemOwner->save();

        if ($mineItem->quantity < 100 && $mineItem->item()->first()->rarity === 2000) {
            $mine->layer = MiningController::getNextLayer($mine->layer);
        }

        $mine->integrity = $mine->integrity - 1;
        $mine->save();
    }

    public static function getNextLayer($layer) {
        if ($layer === 'sedimentary') {
            return 'igneous extrusive';
        }

        if ($layer === 'igneous extrusive') {
            return 'metamorphic';
        }

        if ($layer === 'metamorphic') {
            return 'igneous intrusive';
        }

        if ($layer === 'igneous intrusive') {
            return 'igneous intrusive';
        }
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
        $user = Auth::user();

        // TODO = requires a pick of some sort
        $recipe = (object)[];
        $recipe->id = 1;
        $recipe->ingredients = [];

        $outputId = $request->input('itemId');
        $outputType = $request->input('itemType');

        $stoneCount = $user->characters()->first()->zone()->first()->mine()->first()->items()
            ->where('item_id', $outputId)
            ->where('item_type', $outputType)
            ->count();

        if ($stoneCount < 1) {
            return response()->json('Stone not found', 400);
        }

        return $this->doActivity($recipe, $outputId, $outputType);
    }

    public function reinforce(Request $request) {
        // TODO = requires some planks of wood and building stuff of some sort
        $recipe = (object)[];
        $recipe->id = 2;
        $recipe->ingredients = [];

        return $this->doActivity($recipe);
    }

    public function listResources(Request $request) {
        $user = Auth::user();

        $mine = $user->characters()->first()->zone()->first()->mine()->first();

        $stones = $mine->items()->get();

        $sedimentaryStones = [];
        $igneousExtrusiveStones = [];
        $metamorphicStones = [];
        $igneousIntrusiveStones = [];

        foreach ($stones as $stone) {
            $stone->name = $stone->item()->description;

            if (!$stone->item()->layer) {
                array_push($sedimentaryStones, $stone);
            }

            if ($stone->item()->layer === 'sedimentary') {
                array_push($sedimentaryStones, $stone);
            }

            if ($stone->item()->layer === 'igneous extrusive') {
                array_push($igneousExtrusiveStones, $stone);
            }

            if ($stone->item()->layer === 'metamorphic') {
                array_push($metamorphicStones, $stone);
            }

            if ($stone->item()->layer === 'igneous intrusive') {
                array_push($igneousIntrusiveStones, $stone);
            }
        }

        $accessibleStones = $sedimentaryStones;

        if ($mine->layer === 'sedimentary') {
            return response()->json($accessibleStones, 200);
        }

        if ($mine->layer === 'igneous extrusive') {
            $accessibleStones = array_merge($accessibleStones, $igneousExtrusiveStones);
            return response()->json($accessibleStones, 200);
        }

        if ($mine->layer === 'metamorphic') {
            $accessibleStones = array_merge($accessibleStones, $metamorphicStones);
            return response()->json($accessibleStones, 200);
        }

        if ($mine->layer === 'igneous intrusive') {
            $accessibleStones = array_merge($accessibleStones, $igneousIntrusiveStones);
            return response()->json($accessibleStones, 200);
        }

        return response()->json("Unknown error", 400);
    }

    public function doActivity($activityRecipe, $outputId=null, $outputType=null) {
        $user = Auth::user();
        $character = $user->characters()->first();

        $activityController = new ActivityController;
        // TODO - add helpful tools. Can also be done by hand mind you.
        // $activityController->tools = $itemUse->item()->first()->items()->first();
        $activityController->worker = $character;

        $activity = $activityController->createActivity($character, "mining", $activityRecipe, $outputId, $outputType);

        $character->activity_id = $activity->id;
        $character->save();

        $activityController->workOnActivity();

        return response()->json($activity, 200);
    }
}