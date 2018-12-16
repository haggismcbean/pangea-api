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

    public function attack(Character $character) {
        //DEV
        // $user = Auth::user();
        // $character = $user->characters()->first();
        // //END DEV

        // $character->health = 22;
        // $character->save();

        // AttackCharacter::dispatch($character)->delay(now()->addSeconds(10));

        // return response()->json($character, 200);

        //working

        //DEV
        $user = Auth::user();
        $character = $user->characters()->first();
        //END DEV

        $job = new AttackCharacter($character);

        $job->dispatch($character);

        return response()->json($character, 200);
        //end working
        // $character is the character to be attacked

        // the user's character is the character doing the attacking.

        // so we add to the queue, the request to do the attacking. 

        // 1 - create a job ('attack character' or some such)

        // 2 - dispatch the job

        // 3 - when the job is done, broadcast the results

        // 4 - test it out!
    }
}