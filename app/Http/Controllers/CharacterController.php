<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;
use App\Zone;
use App\Item;
use App\ItemOwner;
use App\Message;
use App\Events\MessageSent;

use App\MadeItem;
use App\MadeItemRecipe;
use App\ItemUse;
use App\CharacterName;

use App\Jobs\AttackCharacter;
use App\Jobs\WorkOnActivity;
use App\Jobs\Hunt;

use App\Http\Controllers\CraftingController;
use App\Http\Controllers\HuntController;

use App\Names\DeathFactory;
use App\Names\EatingFactory;

class CharacterController extends Controller
{
    private $HUNGER_YEILD = 8;

    public static function getCharacter($characterId) {
        $user = Auth::user();

        $character = $user->characters()
            ->find($characterId);

        if ($character) {
            return $character;
        } else {
            $character = $user->characters()
                ->withTrashed()
                ->find($characterId);

            if ($character->is_dead) {
                $message = DeathFactory::getOfflineMessage($character);
                broadcast(new MessageSent($character, $message));

                // okay so if a character dies, we want that to be handled on the front end
                // we first off just show the 'died offline' message
                //
                $character->delete();

                // then we need to handle on the front end a way to create a new character if the user so pleases it
                return $character;
            } else {
                return null;
            }
        }
    }

    public function inventory(Character $character) {
        $user = Auth::user();

        if ($character == $user->characters()->first()) {
            $result = $character->itemOwners()
                ->leftJoin('items', 'item_id', '=', 'items.id')
                ->get();

            foreach ($result as $item) {
                if ($item->item_type == 'plant') {
                    $item->customName = $item->item()->first()->itemDetails()->getName($character);
                }
            }

            return response()->json($result, 200);
        } else {
            return response()->json(['message' => "Cannot get inventory of another character"], 401);
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
        $character->location_id = Zone::find(1)->location_id;

        $character->save();

        // Naming the character
        $characterName = new CharacterName();
        $characterName->custom_name = $character->name;
        $characterName->named_character_id = $character->id;
        $characterName->character_id = $character->id;
        $characterName->save();

        return response()->json($character, 201);
    }

    public function get() {
        // fetch all characters for this USER
        $user = Auth::user();
        $character = $user->characters()->first();

        // TODO - proper embark experience with screen where you create a character!
        if (!$character) {
            return $this->create();
        }

        return Character::where('user_id', $user->id)->withTrashed()->get();
    }

    public function show() {
        // fetch all characters for this ZONE
        $user = Auth::user();
        $activeCharacter = $user->characters()->first();

        if (!$activeCharacter) {
            return response()->json(['message' => "No active character"], 400);
        }

        $zone = $activeCharacter->zone()->first();

        if ($zone->parent_zone) {
            $characters = Character::where('zone_id', $activeCharacter->zone_id)->get();
        } else {
            // wilderness
            $characters = Character::where('group_id', $activeCharacter->group_id)->get();
        }


        foreach ($characters as $character) {
            $character->name = $character->getName($activeCharacter);
        }

        return $characters;
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
            return response()->json(['message' => "Must be a positive whole number"], 400);
        }

        $character = $user->characters()->first();
        $zone = $character->zone()->first();

        return ItemOwnerController::moveItemFromTo($character, $zone, 'zone', $itemId, $itemQuantity);
    }

    public function give(Request $request) {
        $user = Auth::user();

        $itemId = $request->input('itemId');
        $itemQuantity = $request->input('itemQuantity');
        $characterId = $request->input('characterId');

        if ($itemQuantity < 0 || !$this->isInteger($itemQuantity)) {
            return response()->json(['message' => "Must be a positive whole number"], 400);
        }

        $character = $user->characters()->first();
        $targetCharacter = Character::find($characterId);

        if ($character->zone_id != $targetCharacter->zone_id) {
            return response()->json(['message' => "You cannot give things to someone in a different zone"], 400);
        }

        return ItemOwnerController::moveItemFromTo($character, $targetCharacter, 'character', $itemId, $itemQuantity);
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

    public function eat(Request $request) {
        $user = Auth::user();
        $character = $user->characters()->first();

        $item = $character->items()
            ->where('item_id', $request->itemId)
            ->first();

        $itemOwner = ItemOwner::where('owner_id', $character->id)
            ->where('owner_type', 'character')
            ->where('item_id', $item->id)
            ->first();

        if ($itemOwner->count == 0) {
            return response()->json(['message' => "You cannot eat something you do not have in your inventory"], 400);
        }

        // is it food?
        // TODO - eat meat?!
        if ($item->item_type != 'plant') {
            $message = EatingFactory::getInedibleMessage($item->name, $character);
            broadcast(new MessageSent($character, $message));
            return;
        }

        $itemOwner->count = $itemOwner->count - 1;
        $itemOwner->save();

        // TODO - poisons of varying strengths!
        if ($item->itemDetails()->isPoisonous) {
            $damage = rand(0, 100);
            $character->health = $character->health - $damage;

            if ($character->health > 0) {
                $message = EatingFactory::getPoisonousMessage($item->name, $character);
                broadcast(new MessageSent($character, $message));
            } else {
                $character->is_dead = true;
                $character->save();

                $message = DeathFactory::getPoisonMessage($character);

                broadcast(new MessageSent($character, $message));
                $character->delete();
            }

            return;
        }

        // food yield is multiplied by 8 to calculate hunger restore.
        $character->hunger = $character->hunger + ($item->efficiency * $this->HUNGER_YEILD);
        if ($character->hunger > 100) {
            $character->hunger = 100;
        }
        $character->save();

        $message = EatingFactory::getEdibleMessage($item->name, $character);
        broadcast(new MessageSent($character, $message));
    }

    private function isInteger($variable) {
        if ( strval($variable) !== strval(intval($variable)) ) {
            return false;
        }

        return true;
    }

    public function getDeathMessage($request) {

        $character = Character::withTrashed()->where('id', $request)->first();

        if ($character->is_dead == 0) {
            return response()->json(['message' => "Cannot get death message of living character"], 401);
        }

        $messages = $character->messages()->where('source_name', 'death')->get();

        if ($messages->count() == 0) {
            return [DeathFactory::getOfflineMessage($character)];
        }

        return $messages;
    }

    public function lastMessage(Character $character) {
        return $character->messages()
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function name(Request $request) {
        $user = Auth::user();
        $character = $user->characters()->first();

        $namedCharacterId = $request->input('namedCharacterId');
        $newName = $request->input('name');

        $characterName = CharacterName::where('named_character_id', $namedCharacterId)
            ->where('character_id', $character->id)
            ->first();

        if (!$characterName) {
            $characterName = new CharacterName;
        }

        $characterName->custom_name = $newName;
        $characterName->named_character_id = $namedCharacterId;
        $characterName->character_id = $character->id;

        $characterName->save();
        return $characterName;
    }
}