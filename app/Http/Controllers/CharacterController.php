<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;

class CharacterController extends Controller
{

    public function createNewCharacter() {
        // okay so users create a new character. It's randomly assigned appearance, backstory, personality.
        // so what does this mean? we create a new entry in the database, associated with current userId.
        // it's given random name and descriptions. The descriptions I guess are better just generated and saved rather than made new every time. It'd be cool if they change over time one day, eg through a cron job and events, so we'll need to save the description components somewhere as well (ie weight, height, hair colour, and so on)

        // firstly! Lets write our own laravel tutorial, detailing how to create tables, relations, so on and so forth :thumbsup:
        $character = new Character();
        $character->save();
        return response()->json($character, 201);
    }
}