<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Zone;

use App\Http\Controllers\LocationController;

class ZoneController extends Controller
{

    public function getBorderingZones(Request $request) {
        $user = Auth::user();

        $zoneId = $request->input('zone_id');

        $newZones = $this->getBorderingZonesById($zoneId, $user);

        return response()->json($newZones, 200);
    }

    private function getBorderingZonesById($zoneId, $user) {
        $currentZone = $user->characters()->where('zone_id', $zoneId)->first();

        if (!$currentZone) {
            return response()->json(['status' => 'Zone could not be found'], 403);
        }

        if ($currentZone->parent_id > 0) {
            $newZones = Zone::where('location_id', $currentZone->location_id)
                ->where('parent_zone', $currentZone->parent_zone)
                ->orWhere('id', $currentZone->parent_zone)
                ->orWhere('parent_zone', $currentZone->id)
                ->get();

            $newZones = (object) [
                'zones' => $newZones,
                'borderZones' => null
            ];

            return $newZones;
        } else {
            $newZones = Zone::where('location_id', $currentZone->location_id)
                ->where('parent_zone', $currentZone->id)
                ->get();

            $borderZones = LocationController::getBorderingZones($currentZone->location_id);

            $newZones = (object) [
                'zones' => $newZones,
                'borderZones' => $borderZones
            ];

            return $newZones;
        }
    }

    public function changeZones(Request $request) {
        $user = Auth::user();

        $newZoneId = $request->input('zone_id');

        $character = $user->characters()->first();
        $currentZone = $character->zone()->first();

        if (!$currentZone) {
            return response()->json(['status' => 'Current zone could not be found'], 403);
        }

        $borderingZones = $this->getBorderingZonesById($currentZone->id, $user);

        $targetZone = null;

        $targetZone = $this->getTargetZoneFromCurrentLocation($borderingZones, $newZoneId);

        if (!$targetZone) {
            $targetZone = $this->getTargetZoneFromNeighbouringLocation($borderingZones, $newZoneId);
        }

        if (!$targetZone) {
            return response()->json(['status' => 'Target zone could not be found'], 403);
        }

        $character->zone_id = $targetZone->id;
        $character->location_id = $targetZone->location_id;
        $character->save();

        return response()->json($targetZone, 200);
    }

    private function getTargetZoneFromCurrentLocation($borderingZones, $newZoneId) {
        foreach($borderingZones->zones as $borderingZone) {
            if ($newZoneId == $borderingZone->id) {
                return $borderingZone;
            }
        }
    }

    private function getTargetZoneFromNeighbouringLocation($borderingZones, $newZoneId) {
        $borderZoneCardinals = array("north", "east", "south", "west");
        foreach($borderZoneCardinals as $cardinal) {
            if ($borderingZones->borderZones->$cardinal && $newZoneId == $borderingZones->borderZones->$cardinal->id) {
                return $borderingZones->borderZones->$cardinal;
            }
        }
    }
}