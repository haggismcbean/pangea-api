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
        $this->gender = rand(0, 1);
        $this->height = rand(70, 140);
        $this->weight = rand(40, 100);
        $this->strength = rand(1, 10);
        $this->cheek_type = CharacterTraits::getRandomTrait("cheeksTypes");
        $this->jaw_type = CharacterTraits::getRandomTrait("jawTypes");
        $this->skin_colour = CharacterTraits::getRandomTrait("skinColours");
        $this->skin_type = CharacterTraits::getRandomTrait("skinTypes");
        $this->skin_hairiness = CharacterTraits::getRandomTrait("skinHairiness");
        $this->hair_colour = CharacterTraits::getRandomTrait("hairColours");
        $this->hair_type = CharacterTraits::getRandomTrait("hairTypes");
        $this->nose = CharacterTraits::getRandomTrait("noseShapes");
        $this->mouth = CharacterTraits::getRandomTrait("mouthShapes");
        $this->eye_type = CharacterTraits::getRandomTrait("eyesColours");
        $this->eye_colour = CharacterTraits::getRandomTrait("eyesTypes");
        $this->eyebrow_type = CharacterTraits::getRandomTrait("eyebrowsTypes");
    }
}
