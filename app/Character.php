<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\CharacterAppearanceTraits;
use App\Traits\CharacterPersonalityTraits;
use App\Traits\CharacterBackgroundTraits;
use App\MessageFormer\MessageFormer;
use App\Names\NameFactory;
// use App\Message;


class Character extends Model
{
    private $age;

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
        $this->age = $age ? $age : rand(21, 35);
        $this->pronoun = $this->gender === "male" ? "he" : "she";
        $this->posessivePronoun = $this->gender === "male" ? "his" : "her";
        $this->forename = NameFactory::getRandomForename($this->gender);
        $this->surname = NameFactory::getRandomSurname();
        $this->name = $this->forename . " " . $this->surname;
        $this->createRandomAppearance();
        $this->createRandomPersonality();
        $this->createRandomBackstory();
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

    private function createRandomAppearance()
    {
        CharacterAppearanceTraits::init();

        $this->height = rand(70, 140);
        $this->weight = rand(40, 100);
        $this->strength = rand(1, 10);
        $skin_colour = CharacterAppearanceTraits::getRandomTrait("skinColours", $this);
        $skin_type = CharacterAppearanceTraits::getRandomTrait("skinTypes", $this);
        $skin_hairiness = CharacterAppearanceTraits::getRandomTrait("skinHairiness", $this);
        $cheek_type = CharacterAppearanceTraits::getRandomTrait("cheeksTypes", $this);
        $jaw_type = CharacterAppearanceTraits::getRandomTrait("jawTypes", $this);
        $hair_colour = CharacterAppearanceTraits::getRandomTrait("hairColours", $this);
        $hair_type = CharacterAppearanceTraits::getRandomTrait("hairTypes", $this);
        $nose = CharacterAppearanceTraits::getRandomTrait("noseShapes", $this);
        $mouth = CharacterAppearanceTraits::getRandomTrait("mouthShapes", $this);
        $eye_colour = CharacterAppearanceTraits::getRandomTrait("eyesColours", $this);
        $eye_type = CharacterAppearanceTraits::getRandomTrait("eyesTypes", $this);
        $eyebrow_type = CharacterAppearanceTraits::getRandomTrait("eyebrowsTypes", $this);

        $message = new MessageFormer();
        $message->addSentence("{{name}} is a {{gender}}", $this);
        $message->addSentence("{{pronoun}} is " . $this->age . " years old", $this);
        $message->addSentence("{{pronoun}} is " . $this->height . "cm tall", $this);
        $message->addSentence("{{pronoun}} weighs " . $this->weight . "kg", $this);
        $message->formSentence($skin_colour, $this);
        $message->formSentence($skin_type, $this);
        $message->formSentence($skin_hairiness, $this);
        $message->formSentence($cheek_type, $this);
        $message->formSentence($jaw_type, $this);
        $message->formSentence($hair_colour, $this);
        $message->formSentence($hair_type, $this);
        $message->formSentence($nose, $this);
        $message->formSentence($mouth, $this);
        $message->formSentence($eye_colour, $this);
        $message->formSentence($eye_type, $this);
        $message->formSentence($eyebrow_type, $this);

        $this->appearance = $message->message;
    }

    private function createRandomPersonality()
    {
        CharacterPersonalityTraits::init();

        $enjoys = CharacterPersonalityTraits::getRandomTrait("enjoys", $this);
        $believes = CharacterPersonalityTraits::getRandomTrait("believes", $this);
        $aLargeGroup = CharacterPersonalityTraits::getRandomTrait("aLargeGroup", $this);
        $aSeriousConversation = CharacterPersonalityTraits::getRandomTrait("aSeriousConversation", $this);

        $message = new MessageFormer();
        $message->formSentence($enjoys, $this);
        $message->formSentence($believes, $this);
        $message->formSentence($aLargeGroup, $this);
        $message->formSentence($aSeriousConversation, $this);

        $this->personality = $message->message;
    }

    private function createRandomBackstory()
    {
        CharacterBackgroundTraits::init();

        $born = CharacterBackgroundTraits::getRandomTrait("born", $this);
        $fatherWas = CharacterBackgroundTraits::getRandomTrait("fatherWas", $this);
        $motherWas = CharacterBackgroundTraits::getRandomTrait("motherWas", $this);
        $notableParent = rand(0, 1) === 0 ? "father" : "mother";
        $notableParentWas = CharacterBackgroundTraits::getRandomTrait("notableParentWas", $this);
        $graduated = CharacterBackgroundTraits::getRandomTrait("graduated", $this);
        $teachersReportsSay = CharacterBackgroundTraits::getRandomTrait("teachersReportsSay", $this);
        $furtherEductation = CharacterBackgroundTraits::getRandomTrait("furtherEductation", $this);
        $citation = CharacterBackgroundTraits::getRandomTrait("citation", $this);
        $commendation = CharacterBackgroundTraits::getRandomTrait("commendation", $this);
        $wasSoBoredThey = CharacterBackgroundTraits::getRandomTrait("wasSoBoredThey", $this);

        $message = new MessageFormer();
        $message->formSentence($born, $this);
        $message->formSentence($fatherWas, $this);
        $message->formSentence($motherWas, $this);
        $message->formSentence($notableParentWas, $this);
        $message->formSentence($graduated, $this);
        $message->formSentence($teachersReportsSay, $this);
        $message->formSentence($furtherEductation, $this);
        $message->formSentence($citation, $this);
        $message->formSentence($commendation, $this);
        $message->formSentence($wasSoBoredThey, $this);

        $this->backstory = $message->message;
    }
}
