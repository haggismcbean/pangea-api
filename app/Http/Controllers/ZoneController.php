<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\LabourCalculator\LabourCalculator;

use App\Character;
use App\Zone;
use App\ZoneName;
use App\ZoneFinder;
use App\LocationPlant;

use App\World\Clock;

use App\Http\Controllers\LocationController;

use App\Names\WeatherFactory;
use App\Factories\BiomeFactory;

class ZoneController extends Controller
{
    public static function createZone(Zone $parentZone, $zoneName, $zoneDescription, $character) {
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

        if (!$parentZone->parent_zone) {
            // this zone will be hidden in lists from everyone except those who 'know' it
            // so we have to assign the creator as a knower of the zone.
            $zoneFinder = new ZoneFinder;
            $zoneFinder->character_id = $character->id;
            $zoneFinder->zone_id = $zone->id;
            $zoneFinder->save();
        }

        return $zone;
    }

    public function plants(Zone $zone) {
        $user = Auth::user();

        $character = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$character) {
            return response()->json(['message' => 'Zone could not be found'], 403);
        }

        $location = $zone->location()->first();

        $plants = $location->plants()->get();

        // So we only want to show the bits of plants that are in season.
        foreach ($plants as $plant) {
            $plant->customName = $plant->getName($character);
            $plant->setOutOfSeasonProperties();
            $plant->locationPlant = LocationPlant::where('plant_id', $plant->id)->where('location_id', $location->id)->first();
            $plant->availableFruitYield = $plant->getTodaysAvailableYield('fruit');
            $plant->availableFlowerYield = $plant->getTodaysAvailableYield('flower');
            $plant->availableSeedYield = $plant->getTodaysAvailableYield('seed');
            $plant->availableLeafYield = $plant->getTodaysAvailableYield('leaf');
            $plant->availableStalkYield = $plant->getTodaysAvailableYield('stalk');
            $plant->availableRootYield = $plant->getTodaysAvailableYield('root');
        }

        return response()->json($plants, 200);
    }

    public function wakeUpText(Zone $zone) {
        $user = Auth::user();

        $currentCharacter = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$currentCharacter) {
            return response()->json(['message' => 'Zone could not be found'], 403);
        }

        $biomeDescription = new BiomeFactory();

        $biomeDescription->zone = $currentCharacter->zone()->first();

        return response()->json($biomeDescription, 200);
    }

    public function description(Zone $zone) {
        $user = Auth::user();

        $currentCharacter = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$currentCharacter) {
            return response()->json(['message' => 'Zone could not be found'], 403);
        }

        $location = $zone->location()->first();

        $zone->weather = WeatherFactory::getMessage($location->current_temperature, $location->current_temperature);
        $zone->season = Clock::getSeason();
        $zone->current_temperature = $location->current_temperature;
        $zone->current_rainfall = $location->current_temperature;

        if ($zone->parent_zone) {
            $zone->characters = $zone->characters()->get();

            foreach ($zone->characters as $character) {
                $character->name = $character->getName($currentCharacter);
            }
        }

        $zone->customName = $zone->getName($currentCharacter);

        return response()->json($zone, 200);

    }

    public function characters(Zone $zone) {
        $user = Auth::user();

        $currentZone = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$currentZone) {
            return response()->json(['message' => 'Zone could not be found'], 403);
        }

        $characters = $zone->characters()->get();

        return response()->json($characters, 200);
    }

    public function inventory(Zone $zone) {
        $user = Auth::user();

        $currentZone = $user->characters()->where('zone_id', $zone->id)->first();

        if (!$currentZone) {
            return response()->json(['message' => 'Zone could not be found'], 403);
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
            return response()->json(['message' => 'Can\'t get activities of zone character is not in'], 403);
        }

        $activities = $currentZone->activities()->get();

        foreach ($activities as $key => $activity) {
            $activity->ingredients = $activity->ingredients()->get();
            $recipe = $activity->recipe()->first();

            if ($recipe) {
                $activity->item = $recipe->item()->first();
                $activity->requiredIngredients = $recipe->ingredients()->get();
            }

            foreach ($activity->ingredients as $key => $ingredient) {
                $ingredient->item = $ingredient->item()->first();
            }
        }

        return response()->json($activities, 200);
    }

    public function getBorderingZones(Zone $zone) {
        $user = Auth::user();

        $newZones = $this->getKnownBorderingZonesById($zone->id, $user);

        return response()->json($newZones, 200);
    }

    public function getBorderingZonesById($zoneId, $user) {
        $currentZone = $user->characters()->where('zone_id', $zoneId)->first()->zone()->first();

        $character = $user->characters()->first();

        if (!$currentZone) {
            return response()->json(['message' => 'Zone could not be found'], 403);
        }

        if ($currentZone->parent_zone > 0) {
            $parentZone = Zone::find($currentZone->parent_zone);
            $parentZone->customName = $parentZone->getName($character);

            // we show all sibling zones further down, but if you're in a clearing you don't see the other clearings unless you've discovered them
            if ($parentZone->parent_zone === null) {
                $siblingZones = Zone::where('parent_zone', $currentZone->parent_zone)
                    ->join('zone_finders', 'zones.id', '=', 'zone_finders.zone_id')
                    ->where('zones.id', '!=', $currentZone->id)
                    ->where('character_id', $character->id)
                    ->get();
            } else {
                $siblingZones = Zone::where('parent_zone', $currentZone->parent_zone)
                    ->where('id', '!=', $currentZone->id)
                    ->get();
            }

            $childZones = Zone::where('parent_zone', $currentZone->id)->get();

            foreach ($siblingZones as $zone) {
                if (isset($zone)) {
                    $zone->customName = $zone->getName($character);
                }
            }

            foreach ($childZones as $zone) {
                $zone->customName = $zone->getName($character);
            }

            $newZones = (object) [
                'parentZone' => $parentZone,
                'siblingZones' => $siblingZones,
                'childZones' => $childZones
            ];

            return $newZones;
        } else {
            // From wilderness, we only show zones that the character concerned knows about.
            $siblingZones = LocationController::getBorderingZones($currentZone->location_id);
            $childZones = Zone::where('parent_zone', $currentZone->id)->get();

            foreach ($siblingZones as $zone) {
                if (isset($zone)) {
                    $zone->customName = $zone->getName($character);
                }
            }

            foreach ($childZones as $key => $zone) {
                $zone->customName = $zone->getName($character);
            }

            $newZones = (object) [
                'siblingZones' => $siblingZones,
                'childZones' => $childZones
            ];

            return $newZones;
        }
    }

    public function getKnownBorderingZonesById($zoneId, $user) {
        $currentZone = $user->characters()->where('zone_id', $zoneId)->first()->zone()->first();
        $character = $user->characters()->first();

        $borderingZones = $this->getBorderingZonesById($zoneId, $user);

        if (!$currentZone->parent_zone) {
            $actualChildZones = array();

            foreach ($borderingZones->childZones as $key => $zone) {
                if ($zone->isFoundBy($character)) {
                    $zone->customName = $zone->getName($character);
                    array_push($actualChildZones, $zone);
                }
            }

            $borderingZones->childZones = $actualChildZones;
        }

        return $borderingZones;
    }

    public function changeZones(Zone $zone) {
        $user = Auth::user();

        $newZoneId = $zone->id;

        $character = $user->characters()->first();
        $currentZone = $character->zone()->first();

        if (!$currentZone) {
            return response()->json(['message' => 'Current zone could not be found'], 403);
        }

        $borderingZones = $this->getKnownBorderingZonesById($currentZone->id, $user);

        $targetZone = $this->getTargetZoneFromCurrentLocation($borderingZones, $newZoneId);

        if (!$targetZone && isset($borderingZones)) {
            $targetZone = $this->getTargetZoneFromNeighbouringLocation($borderingZones, $newZoneId);
        }

        if (!$targetZone) {
            return response()->json(['message' => 'Target zone could not be found'], 403);
        }

        $travelController = new TravelController;
        $response = $travelController->changeZones($targetZone);

        return response()->json($response, 200);
    }

    public function pickUp(Request $request) {
        $user = Auth::user();

        $itemId = $request->input('itemId');
        $itemQuantity = $request->input('itemQuantity');

        if ($itemQuantity < 0 || !$this->isInteger($itemQuantity)) {
            return response()->json(['message' => "Must be a positive whole number"], 400);
        }

        $character = $user->characters()->first();
        $zone = $character->zone()->first();

        return ItemOwnerController::moveItemFromTo($zone, $character, 'character', $itemId, $itemQuantity);
    }

    private function getTargetZoneFromCurrentLocation($borderingZones, $newZoneId) {
        if ($borderingZones->siblingZones) {
            foreach($borderingZones->siblingZones as $borderingZone) {
                if ($borderingZone && $newZoneId == $borderingZone->id) {
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

        if (isset($borderingZones->parentZone)) {
            if ($newZoneId == $borderingZones->parentZone->id) {
                return $borderingZones->parentZone;
            }
        }
    }

    private function getTargetZoneFromNeighbouringLocation($borderingZones, $newZoneId) {
        $borderZoneCardinals = array("north", "east", "south", "west");
        foreach($borderZoneCardinals as $cardinal) {
            if (isset($borderingZones->borderZones) && $borderingZones->borderZones->$cardinal && $newZoneId == $borderingZones->borderZones->$cardinal->id) {
                return $borderingZones->borderZones->$cardinal;
            }
        }
    }

    private function isInteger($variable) {
        if (strval($variable) !== strval(intval($variable)) ) {
            return false;
        }

        return true;
    }

    public function name(Request $request) {
        $user = Auth::user();
        $character = $user->characters()->first();

        $zoneId = $request->input('zoneId');
        $newName = $request->input('name');

        $zoneName = ZoneName::where('zone_id', $zoneId)
            ->where('character_id', $character->id)
            ->first();

        if (!$zoneName) {
            $zoneName = new ZoneName;
        }

        $zoneName->zone_name = $newName;
        $zoneName->zone_id = $zoneId;
        $zoneName->character_id = $character->id;

        $zoneName->save();
        return $zoneName;
    }

    public function share(Request $request) {
        $user = Auth::user();
        $sharingCharacter = $user->characters()->first();

        $zone = Zone::find($request->input('zoneId'));
        $character = Character::find($request->input('characterId'));

        $zoneName = $zone->getName($sharingCharacter);
        $newZoneName = $zone->names()->where('character_id', $sharingCharacter->id)->first();

        // create zone name
        if ($newZoneName) {
            $zoneName = $zone->names()->where('character_id', $character->id)->first();
            
            if (!$zoneName) {
                $zoneName = new ZoneName;
                $zoneName->zone_id = $zone->id;
                $zoneName->character_id = $character->id;
            }

            $zoneName->zone_name = $newZoneName->zone_name;
            $zoneName->save();
        }


        // create zoneFinder
        $newZoneFinder = $zone->finders()->where('character_id', $character->id)->first();

        if (!$newZoneFinder) {
            $newZoneFinder = new ZoneFinder;
            $newZoneFinder->character_id = $character->id;
            $newZoneFinder->zone_id = $zone->id;
        }

        $newZoneFinder->save();
    }
}
