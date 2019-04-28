<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HuntController;

use App\Activity;
use App\Jobs\ActivityJob;
use App\Jobs\Hunt;

class ActivityController extends Controller
{
    public $tools;
    public $workers;
    public $activity;
    public $machines;
    public $skill;

    private $SUCCESS = 'SUCCESS';
    private $FAILURE = 'FAILURE';
    private $DEATH = 'DEATH';

    public function __construct($activity = null){
        $this->activity = $activity;
    }

    public function createActivity($character, $activityType) {
        // So this one is called from the necessary controllers.
        // It creates an activity which holds enough details from which we can link back up with the necessary controller later


        $this->activity = new Activity;
        $this->activity->character_id = $character->id;
        $this->activity->zone_id = $character->zone()->first()->id;
        $this->activity->recipe_id = null; //??
        // $this->activity->recipe_type = ?? // Use this to work out which function to call (in the controller)
        $this->activity->progress = 0;
        $this->activity->type = $activityType; // Use this to work out which controller to call

        // $this->activity->delay = 10 (standard of 10, but we could change this when necessary...)
        // $this->activity->last_story_id = nullable, tells the last story told so we can chain them easily

        $this->activity->save();

        return $this->activity;
    }

    public function stopWorkOnActivity() {

    }

    public function cancelActivity() {

    }

    public function addIngredientsToActivity() {

    }

    public function workOnActivity() {
        $this->validateWorkOnActivity();

        $result = $this->calculateResult($this->tools, $this->machines, $this->workers, $this->skill);

        $this->sendMessage($this->activity, $result);

        if ($result === $this->SUCCESS) {
            $this->cancelActivity();
            $this->resolveActivity();
        }

        if ($result === $this->FAILURE) {
            $this->loopWorkOnActivity();
        }

        if ($result === $this->DEATH) {
            $this->cancelActivity();
            // TODO - kill the character :P
        }
    }

    private function validateWorkOnActivity() {
        if ($this->workers->activity_id !== $this->activity->id) {
            throw new Error("Character is not currently working on this activity");
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
    private function getWorkers() {
        return;
    }

    // TODO
    private function getSkill() {
        return;
    }

    private function calculateResult($tools, $machines, $workers, $skill) {
        $itemBoost = $tools->efficiency;
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
            HuntController::sendMessage($this->activity, $result, $this->workers);
        }
    }

    private function resolveActivity() {
        if ($this->activity->type === 'hunting') {
            HuntController::resolveActivity($this->activity);
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