<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;
use App\Item;
use App\Message;
use App\Events\MessageSent;

use App\MadeItem;
use App\MadeItemRecipe;
use App\ItemUse;

use App\Jobs\AttackCharacter;
use App\Jobs\WorkOnActivity;
use App\Jobs\Hunt;

use App\Http\Controllers\CraftingController;
use App\Http\Controllers\HuntController;

class CharacterController extends Controller
{
    public static function getCharacter($characterId) {
        $user = Auth::user();

        $character = $user->characters()
            ->withTrashed()
            ->find($characterId);

        if ($character) {
            if ($character->is_dead) {
                $message = DeathFactory::getExposureMessage();
                broadcast(new MessageSent($character, $message));
                $character->delete();
            } else {
                return $character;
            }
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

        return ItemOwnerController::moveItemFromTo($character, $zone, 'zone', $itemId, $itemQuantity);
    }

    public function getCraftables() {
        $user = Auth::user();
        $character = $user->characters()->first();

        // TODO - only return craftables that can be made by this particular character (once skills implemented)

        $madeItems = MadeItem::get();

        foreach ($madeItems as $key => $madeItem) {
            $madeItem->recipes = $madeItem->recipes()->get();

            foreach($madeItem->recipes as $key => $recipe) {
                $recipe->ingredients = $recipe->ingredients()->get();

                foreach($recipe->ingredients as $key => $ingredient) {
                    $ingredient->item = $ingredient->item()->first();
                }
            }
        }

        return response()->json($madeItems, 200);
    }

    private function isInteger($variable) {
        if ( strval($variable) !== strval(intval($variable)) ) {
            return false;
        }

        return true;
    }
}