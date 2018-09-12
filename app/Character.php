<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\CharacterAppearanceTraits;
use App\Traits\CharacterPersonalityTraits;
use App\Names\NameFactory;
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
        $this->gender = rand(0, 1) === 0 ? "male" : "female";
        $this->name = NameFactory::getRandomForename($this->gender) . " " . NameFactory::getRandomSurname();
        $this->createRandomAppearance($age);
        $this->createRandomPersonality();
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
        CharacterAppearanceTraits::init();

        $this->height = rand(70, 140);
        $this->weight = rand(40, 100);
        $this->strength = rand(1, 10);
        $this->skin_colour = CharacterAppearanceTraits::getRandomTrait("skinColours", $this);
        $this->cheek_type = CharacterAppearanceTraits::getRandomTrait("cheeksTypes", $this);
        $this->jaw_type = CharacterAppearanceTraits::getRandomTrait("jawTypes", $this);
        $this->skin_type = CharacterAppearanceTraits::getRandomTrait("skinTypes", $this);
        $this->skin_hairiness = CharacterAppearanceTraits::getRandomTrait("skinHairiness", $this);
        $this->hair_colour = CharacterAppearanceTraits::getRandomTrait("hairColours", $this);
        $this->hair_type = CharacterAppearanceTraits::getRandomTrait("hairTypes", $this);
        $this->nose = CharacterAppearanceTraits::getRandomTrait("noseShapes", $this);
        $this->mouth = CharacterAppearanceTraits::getRandomTrait("mouthShapes", $this);
        $this->eye_type = CharacterAppearanceTraits::getRandomTrait("eyesColours", $this);
        $this->eye_colour = CharacterAppearanceTraits::getRandomTrait("eyesTypes", $this);
        $this->eyebrow_type = CharacterAppearanceTraits::getRandomTrait("eyebrowsTypes", $this);
    }

    private function createRandomPersonality()
    {
        CharacterPersonalityTraits::init();

        $this->enjoys = CharacterPersonalityTraits::getRandomTrait("enjoys", $this);
        $this->believes = CharacterPersonalityTraits::getRandomTrait("believes", $this);
        $this->aLargeGroup = CharacterPersonalityTraits::getRandomTrait("aLargeGroup", $this);
        $this->aSeriousConversation = CharacterPersonalityTraits::getRandomTrait("aSeriousConversation", $this);
    }
}
