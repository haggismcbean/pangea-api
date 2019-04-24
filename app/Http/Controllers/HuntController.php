<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\ActivityItem;

use App\Http\Controllers\ActivityItemController;

use App\MadeItem;
use App\MadeItemRecipe;

use App\Jobs\Hunt;
use App\GameEvents\HuntEvent;

class HuntController extends Controller
{
    public static function hunt($character, $itemBoost) {
        if ($character->activity()->first()->type !== 'hunting') {
            return;
        }

        // roll for chances of success
        // TODO - skills
        $skillBoost = 0;
        $successChance = 0.01 * $skillBoost * $itemBoost;

        $roll = rand(0, 100);

        if ($roll < $successChance) {
            $isSuccess = true;
        } else {
            $isSuccess = false;

            // REPEAT (todo - let users stop if they want!);
            HuntController::loopHuntJob($character, $itemBoost);

            $activity = $character->activity()->first();
            ActivityController::completeActivity($character, $activity);
        }
        
        $huntEvent = new HuntEvent();
        $huntEvent->handle($character, $isSuccess);
    }

    private static function loopHuntJob($character, $itemBoost) {
        $job = new Hunt($character, $itemBoost);

        $job->dispatch($character, $itemBoost)
            ->delay(now()->addSeconds(10));

        return true;
    }
}