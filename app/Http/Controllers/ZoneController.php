<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\LabourCalculator\LabourCalculator;

use App\Zone;

use App\Http\Controllers\LocationController;

use App\Factories\BiomeFactory;

class ZoneController extends Controller
{
    public function plants(Zone $zone) {
        $user = Auth::user();

        $currentCharacter = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$currentCharacter) {
            return response()->json(['status' => 'Zone could not be found'], 403);
        }

        return response()->json($zone->location()->first()->plants()->get(), 200);
    }

    public function description(Zone $zone) {
        $user = Auth::user();

        $currentZone = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$currentZone) {
            return response()->json(['status' => 'Zone could not be found'], 403);
        }

        $biomeDescription = new BiomeFactory();

        return response()->json($biomeDescription, 200);
    }

    public function characters(Zone $zone) {
        $user = Auth::user();

        $currentZone = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$currentZone) {
            return response()->json(['status' => 'Zone could not be found'], 403);
        }

        $characters = $zone->characters()->get();

        return response()->json($characters, 200);
    }

    public function inventory(Zone $zone) {
        $user = Auth::user();

        $currentZone = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$currentZone) {
            return response()->json(['status' => 'Zone could not be found'], 403);
        }

        $inventory = $zone->itemOwners()
            ->leftJoin('items', 'item_id', '=', 'items.id')
            ->get();

        return response()->json($inventory, 200);
    }

    public function getBorderingZones(Zone $zone) {
        $user = Auth::user();

        $newZones = $this->getBorderingZonesById($zone->id, $user);

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

    public function changeZones(Zone $zone) {
        $user = Auth::user();

        $newZoneId = $zone->id;

        $character = $user->characters()->first();
        $currentZone = $character->zone()->first();

        if (!$currentZone) {
            return response()->json(['status' => 'Current zone could not be found'], 403);
        }

        if (LabourCalculator::isTimeLockActive($character)) {
            return response()->json(['status' => 'Time lock active'], 403);
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

        $timeLock = LabourCalculator::calculateTimeLock('travel.land', $character);

        $character->zone_id = $targetZone->id;
        $character->location_id = $targetZone->location_id;
        $character->time_lock = $timeLock;
        $character->save();

        $response = (object) [
            'timeLock' => $timeLock,
            'targetZone' => $targetZone
        ];

        return response()->json($response, 200);
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