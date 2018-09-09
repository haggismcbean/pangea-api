<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\CharacterTraits;
// use App\Message;


class Character extends Model
{
    public $personality;
    public $backstory;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($age = null)
    {
        $this->user_id = 0;
        $this->birthday = Carbon::now();
        // $this->name = CharacterTraits::getRandomName();
        $this->createRandomAppearance($age);
        // $this->personality = $this->createRandomPersonality();
        // $this->backstory = $this->createRandomBackstory();
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

    private function createRandomAppearance($age)
    {
        CharacterTraits::init();

        $this->gender = rand(0, 1);
        $this->height = rand(70, 140);
        $this->weight = rand(40, 100);
        $this->strength = rand(1, 10);
        $this->skin_colour = CharacterTraits::getRandomTrait("skinColours", $this);
        $this->cheek_type = CharacterTraits::getRandomTrait("cheeksTypes", $this);
        $this->jaw_type = CharacterTraits::getRandomTrait("jawTypes", $this);
        $this->skin_type = CharacterTraits::getRandomTrait("skinTypes", $this);
        $this->skin_hairiness = CharacterTraits::getRandomTrait("skinHairiness", $this);
        $this->hair_colour = CharacterTraits::getRandomTrait("hairColours", $this);
        $this->hair_type = CharacterTraits::getRandomTrait("hairTypes", $this);
        $this->nose = CharacterTraits::getRandomTrait("noseShapes", $this);
        $this->mouth = CharacterTraits::getRandomTrait("mouthShapes", $this);
        $this->eye_type = CharacterTraits::getRandomTrait("eyesColours", $this);
        $this->eye_colour = CharacterTraits::getRandomTrait("eyesTypes", $this);
        $this->eyebrow_type = CharacterTraits::getRandomTrait("eyebrowsTypes", $this);
    }
}
