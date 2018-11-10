<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;

class CharacterController extends Controller
{

    public function create() {
        // okay so users create a new character. It's randomly assigned appearance, backstory, personality.
        $character = new Character();
        $character->save();
        return response()->json($character, 201);
    }

    public function show() {
        // fetch all characters
        $user = Auth::user();

        return $user->characters()->get();
    }

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
}