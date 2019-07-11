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
    public static function createZone(Zone $parentZone, $zoneName, $zoneDescription) {
        if ($parentZone->size == 1) {
            return;
        }

        $parentZone->size = $parentZone->size - 1;
        $parentZone->save();

        $zone = new Zone;
        $zone->size = 1;
        $zone->location_id = $parentZone->location_id;
        $zone->parent_zone = $parentZone->id;
        $zone->name = $zoneName;
        $zone->description = $zoneDescription;

        $zone->save();

        return $zone;
    }

    public function plants(Zone $zone) {
        $user = Auth::user();

        $currentCharacter = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$currentCharacter) {
            return response()->json(['status' => 'Zone could not be found'], 403);
        }

        $plants = $zone->location()->first()->plants()->get();

        foreach ($plants as $plant) {
            $plant->customName = $plant->getName($character);
        }

        return response()->json($plants, 200);
    }

    public function wakeUpText(Zone $zone) {
        $user = Auth::user();

        $currentCharacter = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$currentCharacter) {
            return response()->json(['status' => 'Zone could not be found'], 403);
        }

        $biomeDescription = new BiomeFactory();

        $biomeDescription->zone = $currentCharacter->zone()->first();

        return response()->json($biomeDescription, 200);
    }

    public function description(Zone $zone) {
        $user = Auth::user();

        $currentCharacter = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$currentCharacter) {
            return response()->json(['status' => 'Zone could not be found'], 403);
        }

        return response()->json($zone, 200);

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

    public function activities(Zone $zone) {
        $user = Auth::user();

        $currentZone = $user->characters()->first()->zone()->first();

        if ($currentZone != $zone) {
            return response()->json(['status' => 'Can\'t get activities of zone character is not in'], 403);
        }

        $activities = $currentZone->activities()->get();

        foreach ($activities as $key => $activity) {
            $activity->ingredients = $activity->ingredients()->get();
            $recipe = $activity->recipe()->first();

            if ($recipe) {
                $activity->item = $recipe->item()->first();
            }

            foreach ($activity->ingredients as $key => $ingredient) {
                $ingredient->item = $ingredient->item()->first();
            }
        }

        return response()->json($activities, 200);
    }

    public function getBorderingZones(Zone $zone) {
        $user = Auth::user();

        $newZones = $this->getBorderingZonesById($zone->id, $user);

        return response()->json($newZones, 200);
    }

    private function getBorderingZonesById($zoneId, $user) {
        $currentZone = $user->characters()->where('zone_id', $zoneId)->first()->zone()->first();

        if (!$currentZone) {
            return response()->json(['status' => 'Zone could not be found'], 403);
        }

        if ($currentZone->parent_zone > 0) {
            $parentZone = Zone::find($currentZone->parent_zone);
            $siblingZones = Zone::where('parent_zone', $currentZone->parent_zone)->get();
            $childZones = Zone::where('parent_zone', $currentZone->id)->get();

            $newZones = (object) [
                'parentZone' => $parentZone,
                'siblingZones' => $siblingZones,
                'childZones' => $childZones
            ];

            return $newZones;
        } else {
            $siblingZones = LocationController::getBorderingZones($currentZone->location_id);
            $childZones = Zone::where('parent_zone', $currentZone->id)->get();

            $newZones = (object) [
                'siblingZones' => $siblingZones,
                'childZones' => $childZones
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

    public function pickUp(Request $request) {
        $user = Auth::user();

        $itemId = $request->input('itemId');
        $itemQuantity = $request->input('itemQuantity');

        if ($itemQuantity < 0 || !$this->isInteger($itemQuantity)) {
            return response()->json("Must be a positive whole number", 400);
        }

        $character = $user->characters()->first();
        $zone = $character->zone()->first();

        return ItemOwnerController::moveItemFromTo($zone, $character, 'character', $itemId, $itemQuantity);
    }

    private function getTargetZoneFromCurrentLocation($borderingZones, $newZoneId) {
        if ($borderingZones->siblingZones) {
            foreach($borderingZones->siblingZones as $borderingZone) {
                if ($newZoneId == $borderingZone->id) {
                    return $borderingZone;
                }
            }
        }

        if ($borderingZones->childZones) {
            foreach($borderingZones->childZones as $borderingZone) {
                if ($newZoneId == $borderingZone->id) {
                    return $borderingZone;
                }
            }
        }

        if ($borderingZones->parentZone) {
            if ($newZoneId == $borderingZones->parentZone->id) {
                return $borderingZones->parentZone;
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

    private function isInteger($variable) {
        if ( strval($variable) !== strval(intval($variable)) ) {
            return false;
        }

        return true;
    }
}