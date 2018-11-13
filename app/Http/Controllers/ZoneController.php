<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Zone;

use App\Http\Controllers\LocationController;

class ZoneController extends Controller
{

    public function getBorderingZones(Request $request) {
        // todo - check the zoneId is the character's current zoneId.
        $zoneId = $request->input('zone_id');

        $currentZone = Zone::find($zoneId);

        if (!$currentZone) {
            return response()->json(['status' => 'Zone could not be found'], 403);
        }

        if ($currentZone->parent_id > 0) {
            $newZones = Zone::where('location_id', $currentZone->location_id)
                ->where('parent_zone', $currentZone->parent_zone)
                ->orWhere('id', $currentZone->parent_zone)
                ->orWhere('parent_zone', $currentZone->id)
                ->get();

            return response()->json($newZones, 200);
        } else {
            $newZones = Zone::where('location_id', $currentZone->location_id)
                ->where('parent_zone', $currentZone->id)
                ->get();

            $borderZones = LocationController::getBorderingZones($currentZone->location_id);

            $response = (object) [
                'zones' => $newZones,
                'borderZones' => $borderZones
            ];

            return response()->json($response, 200);
        }
    }
}