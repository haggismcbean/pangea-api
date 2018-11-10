<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WorldGenerator\PlantGenerator;

use App\Plant;
use App\Character;
use App\Zone;
use App\LocationPlant;
use App\Item;
use App\ItemOwner;

class PlantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function gather(Request $request) {
        $plantId = $request->input('plantId');
        $character = $this->getCharacter($request->input('characterId'));
        $location = $character->location()
            ->first();
        $locationPlant = $location->locationPlants()
            ->where('plant_id', $plantId)
            ->get()[0];

        if ($locationPlant && $locationPlant->count > 0) {
            LocationPlant::where('id', $locationPlant->id)
                ->update(array('count' => $locationPlant->count - 1));

            // first we find the item
            $item = Item::where('itemType', 'plant')
                ->where('typeId', $plantId)
                ->where('name', 'leaf')
                ->first();

            if (!$item) {
                $item = $this->createNewItem($plantId);
            }

            if ($character->hasInventorySpace()) {
                $itemOwner = ItemOwner::where('ownerType', 'character')
                    ->where('ownerId', $character->id)
                    ->where('itemId', $item->id)
                    ->first();

                if (!$itemOwner) {
                    $itemOwner = $this->createNewItemOwner($character, $item);
                }

            } else {
                $zone = $character->zone()
                    ->first();
                $itemOwner = ItemOwner::where('ownerType', 'zone')
                    ->where('ownerId', $zone->id)
                    ->where('itemId', $item->id)
                    ->first();
            }

            
            $itemOwner->count = $itemOwner->count + 1;
            $itemOwner->save();

            return $itemOwner;
        } else {
            return response()->json(['status' => 'No plants left'], 403);
        }
    }

    private function getCharacter($characterId) {
        $user = Auth::user();
        $characterId = $characterId;

        $character = $user->characters()
            ->find($characterId);

        if ($character) {
            return $character;
        } else {
            return null;
        }
    }

    private function getLocationPlant($location, $plantId) {
        $plant = $location->locationPlants()
            ->find($plantId);

        if ($plant) {
            return $plant;
        } else {
            return null;
        }
    }

    private function createNewItem($plantId) {
        $item = new Item;

        $item->itemType = 'plant';
        $item->typeId = $plantId;
        $item->unitWeight = 1;
        $item->unitVolume = 1;
        $item->rotRate = 1;
        $item->name = 'leaf';
        $item->description = 'A big leaf';

        $item->save();

        return $item;
    }

    private function createNewItemOwner($character, $item) {
        $itemOwner = new ItemOwner;

        $itemOwner->ownerType = 'character';
        $itemOwner->ownerId = $character->id;
        $itemOwner->itemId = $item->id;
        $itemOwner->count = 1;
        $itemOwner->age = 0;
        $itemOwner->quality = 0;

        $itemOwner->save();

        return $itemOwner;
    }
}