<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\CharacterFactory;
use App\Message;


class Character extends Model
{
    private $age;

    protected $notableParent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($age = null)
    {
        $character = new CharacterFactory();

        $this->user_id = 0;
        $this->birthday = $character->birthday;
        $this->gender = $character->gender;
        $this->age = $character->age;
        $this->height = $character->height;
        $this->weight = $character->weight;
        $this->strength = $character->strength;
        $this->pronoun = $character->pronoun;
        $this->posessivePronoun = $character->posessivePronoun;
        $this->forename = $character->forename;
        $this->surname = $character->surname;
        $this->name = $character->name;
        $this->appearance = $character->appearance;
        $this->personality = $character->personality;
        $this->backstory = $character->backstory;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
      return $this->hasMany(Message::class);
    }
}
