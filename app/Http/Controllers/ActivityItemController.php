<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\ActivityItem;
use App\MadeItem;

use App\Jobs\AttackCharacter;

class ActivityItemController extends Controller
{
    public static function createActivityItem($activity, $ingredient) {
    	$activityItem = new ActivityItem;

        $activityItem->activity_id = $activity->id;
        $activityItem->item_id = $ingredient->item_id;
        $activityItem->item_type = $ingredient->item_type;

        $activityItem->quantity_added = 0;

        // TODO - be intelligent about this!
        $activityItem->quantity_required = $ingredient->quantity_min;

        $activityItem->save();

        return $activityItem;
    }
}