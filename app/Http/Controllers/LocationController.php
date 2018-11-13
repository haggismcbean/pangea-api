<?php

namespace App\Http\Controllers;

use App\Location;

class LocationController extends Controller
{

    public static function getBorderingZones($locationId) {
        $currentLocation = Location::find($locationId);

        if (!$currentLocation) {
            throw Error(response()->json(['status' => 'Zone could not be found'], 403)); 
        }

        $north = Location::where('x_coord', $currentLocation->x_coord)
            ->where('y_coord', $currentLocation->y_coord - 1)
            ->first();

        $east = Location::where('x_coord', $currentLocation->x_coord + 1)
            ->where('y_coord', $currentLocation->y_coord)
            ->first();

        $south = Location::where('x_coord', $currentLocation->x_coord)
            ->where('y_coord', $currentLocation->y_coord + 1)
            ->first();

        $west = Location::where('x_coord', $currentLocation->x_coord - 1)
            ->where('y_coord', $currentLocation->y_coord)
            ->first();

        return (object) [
            'north' => LocationController::getBaseZone($north),
            'east' => LocationController::getBaseZone($east),
            'south' => LocationController::getBaseZone($south),
            'west' => LocationController::getBaseZone($west),
        ];
    }

    private static function getBaseZone($location) {
        return $location->zones()
            ->where('parent_zone', 0)
            ->first();
    }
}