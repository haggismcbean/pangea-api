<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\User;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        Message::truncate();

        $character = User::first()->characters()->first();

        Message::create([
            'id' => 1,
            'character_id' => 1,
            'message' => 'Hey you there... You! Where are we? What is this place?',
            'source_id' => $character->id,
            'source_type' => 'character',
            'source_name' => $character->name
        ]);

        Message::create([
            'id' => 2,
            'character_id' => 2,
            'message' => 'Hey you there... You! Where are we? What is this place?',
            'source_id' => $character->id,
            'source_type' => 'character',
            'source_name' => $character->name
        ]);

        Message::create([
            'id' => 3,
            'character_id' => 1,
            'message' => 'Hey! Answer me!',
            'source_id' => $character->id,
            'source_type' => 'character',
            'source_name' => $character->name
        ]);

        Message::create([
            'id' => 4,
            'character_id' => 2,
            'message' => 'Hey! Answer me!',
            'source_id' => $character->id,
            'source_type' => 'character',
            'source_name' => $character->name
        ]);
    }
}
