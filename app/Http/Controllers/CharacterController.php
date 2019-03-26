<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;

use App\Jobs\AttackCharacter;

class CharacterController extends Controller
{
    public static function getCharacter($characterId) {
        $user = Auth::user();

        $character = $user->characters()
            ->find($characterId);

        if ($character) {
            return $character;
        } else {
            return null;
        }
    }

    public function inventory(Character $character) {
        $user = Auth::user();

        if ($character == $user->characters()->first()) {
            $result = $character->itemOwners()
                ->leftJoin('items', 'item_id', '=', 'items.id')
                ->get();

            return response()->json($result, 200);
        } else {
            return response()->json("Cannot get inventory of another character", 401);
        }
    }

    public function create() {
        $user = Auth::user();

        // okay so users create a new character. It's randomly assigned appearance, backstory, personality.
        $character = new Character();
        $character->generate();
        $character->user_id = $user->id;

        // TODO - spawn stuff/embark stuff
        $character->zone_id = 1;

        $character->save();
        return response()->json($character, 201);
    }

    public function show() {
        // fetch all characters for this user
        $user = Auth::user();

        return $user->characters()->get();
    }

    public function attack(Character $character) {
        $user = Auth::user();
        $attacker = $user->characters()->first();

        $job = new AttackCharacter($attacker, $character);

        $job->dispatch($attacker, $character);

        return response()->json($character, 200);
    }

    public function putDown(Request $request) {
        $user = Auth::user();

        $itemId = $request->input('itemId');
        $itemQuantity = $request->input('itemQuantity');

        if ($itemQuantity < 0 || !$this->isInteger($itemQuantity)) {
            return response()->json("Must be a positive whole number", 400);
        }

        $character = $user->characters()->first();
        $zone = $character->zone()->first();

        $characterItem = $character->itemOwners()->where('item_id', $itemId)->first();
        $zoneItem = $zone->itemOwners()->where('item_id', $itemId)->first();
        $item = $characterItem->item()->first();

        if ($characterItem->count < $itemQuantity) {
            return response()->json("Must be less than number of items in your inventory", 400);
        }

        if (!$item || !$characterItem) {
            return response()->json("Item could not be found", 400);
        }

        $characterItem->count = $characterItem->count - $itemQuantity;
        $characterItem->save();

        if (!$zoneItem) {
            ItemOwnerController::createNewItemOwner('zone', $zone, $item, $itemQuantity);
        } else {
            $zoneItem->count = $zoneItem->count + $itemQuantity;
            $zoneItem->save();
        }

        return response()->json($item, 200);
    }

    private function isInteger($variable) {
        if ( strval($variable) !== strval(intval($variable)) ) {
            return false;
        }

        return true;
    }
}