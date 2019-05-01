<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ActivityItemController;
use App\Http\Controllers\HuntController;

use App\Activity;
use App\Jobs\ActivityJob;
use App\Jobs\Hunt;

class ActivityController extends Controller
{
    public $tools;
    public $worker; //TODO - support more than one worker :P
    public $activity;
    public $machines;
    public $skill;

    private $SUCCESS = 'SUCCESS';
    private $FAILURE = 'FAILURE';
    private $DEATH = 'DEATH';

    private $HUNTING_TYPE = 'hunting';
    private $CRAFTING_TYPE = 'crafting';

    public function __construct($activity = null){
        $this->activity = $activity;
    }

    public function createActivity($character, $activityType, $recipe=null) {
        $this->activity = new Activity;
        $this->activity->character_id = $character->id;
        $this->activity->zone_id = $character->zone()->first()->id;
        $this->activity->recipe_id = $recipe->id;
        // $this->activity->recipe_type = ?? // Use this to work out which function to call (in the controller)
        $this->activity->progress = 0;
        $this->activity->type = $activityType; // Use this to work out which controller to call

        // $this->activity->delay = 10 (standard of 10, but we could change this when necessary...)
        // $this->activity->last_story_id = nullable, tells the last story told so we can chain them easily

        $this->activity->save();

        if ($recipe && $recipe->ingredients) {
            foreach ($recipe->ingredients as $key => $ingredient) {
                ActivityItemController::createActivityItem($activity, $ingredient);
            }
        }

        return $this->activity;
    }

    public function stopWorkOnActivity() {
        $this->worker->activity_id = null;
        $this->worker->save();
            
        return response()->json($character, 200);
    }

    public function cancelActivity() {
        $this->activity->destroy($activity->id);

        return $this->stopWorkingOnActivity();
    }

    public function addIngredientsToActivity($character, $item, $amount) {
        $characterItems = $character->itemOwners()->get();

        foreach ($characterItems as $characterItemKey => $characterItem) {

            if ($characterItem->item_id == $item->id) {
                // TODO - validation and remove the correct number of items.
                $characterItem->count = $characterItem->count - $amount;

                $ingredient = $this->activity->ingredients()->where('item_id', $item->id)->first();

                if (!$ingredient) {
                    $ingredient = $this->activity->ingredients()->where('item_type', $item->name)->first();
                }

                if (!$ingredient) {
                    return response()->json("Item could not be found in this activity", 400);
                }

                if ($ingredient->quantity_added == $ingredient->quantity_required) {
                    return response()->json("Item does not need more of that ingredient", 400);
                }

                $ingredient->quantity_added = $ingredient->quantity_added + 1;
                $ingredient->save();

                $characterItem->save();
            }
        }
    }

    public function workOnActivity() {
        $this->validateWorkOnActivity();

        $result = $this->calculateResult($this->tools, $this->machines, $this->worker, $this->skill);

        if ($result === $this->SUCCESS) {
            $this->resolveActivity($this->worker, $this->activity);

            if ($this->activity->progress === 100) {
                $this->cancelActivity();
            } else {
                $this->loopWorkOnActivity();
            }
        }

        if ($result === $this->FAILURE) {
            $this->loopWorkOnActivity();
        }

        if ($result === $this->DEATH) {
            $this->cancelActivity();
            // TODO - kill the character :P
        }

        $this->sendMessage($this->activity, $result);
    }

    private function validateWorkOnActivity() {
        // TODO - check if user is logged in as well :P

        if ($this->worker->activity_id !== $this->activity->id) {
            throw new Error("Character is not currently working on this activity");
        }

        if (!$this->activity->isReadyForWork()) {
            throw new Error("Activity is not ready to be worked on");
        }
    }

    // TODO
    private function getTools() {
        return;
    }

    // TODO
    private function getMachines() {
        return;
    }

    // TODO
    private function getworker() {
        return;
    }

    // TODO
    private function getSkill() {
        return;
    }

    private function calculateResult($tools, $machines, $worker, $skill) {
        if ($tools) {
            $itemBoost = $tools->efficiency;
        } else {
            $itemBoost = 1;
        }

        $skillBoost = 1;
        $successChance = 10000 * $skillBoost * $itemBoost;

        if ($successChance > 998) {
            $successChance = 998;
        }

        // TODO - get chances from the HuntController (or wherever)
        $failureChance = 999;
        $roll = rand(0, 1000);

        if ($roll < $successChance) {
            return $this->SUCCESS;
        }

        if ($roll < $failureChance) {
            return $this->FAILURE;
        }

        return $this->DEATH;
    }

    private function sendMessage($activity, $result) {
        if ($this->activity->type === 'hunting') {
            HuntController::sendMessage($this->activity, $result, $this->worker);
        }

        if ($this->activity->type === 'crafting') {
            CraftingController::sendMessage($this->activity, $this->worker);
        }
    }

    private function resolveActivity() {
        if ($this->activity->type === 'hunting') {
            HuntController::resolveActivity($this->activity, $this->worker);
        }

        if ($this->activity->type === 'crafting') {
            CraftingController::resolveActivity($this->activity, $this->worker);
        }
    }

    private function loopWorkOnActivity() {
        $activityController = $this;

        $activityJob = new ActivityJob($activityController);

        $activityJob->dispatch($activityController)
            // ->delay(now()->addSeconds($this->activity->delay));
            ->delay(now()->addSeconds(10));

        return true;
    }
}