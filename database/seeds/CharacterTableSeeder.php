<?php

use Illuminate\Database\Seeder;
use App\Character;
use App\Zone;
use App\Factories\CharacterFactory;

class CharacterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Let's clear the location table first
        Character::truncate();

        $character = new CharacterFactory();

        DB::table('characters')->insert([
            'user_id' => 1,
            'location_id' => 13236,
            'zone_id' => 1,
            'birthday' => $character->birthday,
            'gender' => $character->gender,
            'height' => $character->height,
            'weight' => $character->weight,
            'strength' => $character->strength,
            'pronoun' => $character->pronoun,
            'posessivePronoun' => $character->posessivePronoun,
            'forename' => $character->forename,
            'surname' => $character->surname,
            'name' => $character->name,
            'appearance' => $character->appearance,
            'personality' => $character->personality,
            'backstory' => $character->backstory,
            'health' => 100,
            'hunger' => 100
        ]);

        $character = new CharacterFactory();

        DB::table('characters')->insert([
            'user_id' => 2,
            'location_id' => 13236,
            'zone_id' => 1,
            'birthday' => $character->birthday,
            'gender' => $character->gender,
            'height' => $character->height,
            'weight' => $character->weight,
            'strength' => $character->strength,
            'pronoun' => $character->pronoun,
            'posessivePronoun' => $character->posessivePronoun,
            'forename' => $character->forename,
            'surname' => $character->surname,
            'name' => $character->name,
            'appearance' => $character->appearance,
            'personality' => $character->personality,
            'backstory' => $character->backstory,
            'health' => 100,
            'hunger' => 100
        ]);
    }
}
