<?php

namespace App\Factories;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\CharacterAppearanceTraits;
use App\Traits\CharacterPersonalityTraits;
use App\Traits\CharacterBackgroundTraits;
use App\MessageFormer\MessageFormer;
use App\Names\NameFactory;


class CharacterFactory extends Model
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
        $this->skin_colour = CharacterAppearanceTraits::getRandomTrait("skinColours", $this);
        $this->skin_type = CharacterAppearanceTraits::getRandomTrait("skinTypes", $this);
        $this->skin_hairiness = CharacterAppearanceTraits::getRandomTrait("skinHairiness", $this);
        $this->cheek_type = CharacterAppearanceTraits::getRandomTrait("cheeksTypes", $this);
        $this->jaw_type = CharacterAppearanceTraits::getRandomTrait("jawTypes", $this);
        $this->hair_colour = CharacterAppearanceTraits::getRandomTrait("hairColours", $this);
        $this->hair_type = CharacterAppearanceTraits::getRandomTrait("hairTypes", $this);
        $this->nose = CharacterAppearanceTraits::getRandomTrait("noseShapes", $this);
        $this->mouth = CharacterAppearanceTraits::getRandomTrait("mouthShapes", $this);
        $this->eye_colour = CharacterAppearanceTraits::getRandomTrait("eyesColours", $this);
        $this->eye_type = CharacterAppearanceTraits::getRandomTrait("eyesTypes", $this);
        $this->eyebrow_type = CharacterAppearanceTraits::getRandomTrait("eyebrowsTypes", $this);

        $message = new MessageFormer();
        $message->addSentence("{{pronoun}} is " . $this->age . " years old", $this);
        $message->addSentence("{{pronoun}} is " . $this->height . "cm tall", $this);
        $message->addSentence("{{pronoun}} weighs " . $this->weight . "kg", $this);
        $message->formSentence($this->skin_colour, $this);
        $message->formSentence($this->skin_type, $this);
        $message->formSentence($this->skin_hairiness, $this);
        $message->formSentence($this->cheek_type, $this);
        $message->formSentence($this->jaw_type, $this);
        $message->formSentence($this->hair_colour, $this);
        $message->formSentence($this->hair_type, $this);
        $message->formSentence($this->nose, $this);
        $message->formSentence($this->mouth, $this);
        $message->formSentence($this->eye_colour, $this);
        $message->formSentence($this->eye_type, $this);
        $message->formSentence($this->eyebrow_type, $this);

        $this->appearance = $message->message;
    }

    private function createRandomPersonality()
    {
        CharacterPersonalityTraits::init();

        $this->enjoys = CharacterPersonalityTraits::getRandomTrait("enjoys", $this);
        $this->believes = CharacterPersonalityTraits::getRandomTrait("believes", $this);
        $this->aLargeGroup = CharacterPersonalityTraits::getRandomTrait("aLargeGroup", $this);
        $this->aSeriousConversation = CharacterPersonalityTraits::getRandomTrait("aSeriousConversation", $this);

        $message = new MessageFormer();
        $message->formSentence($this->enjoys, $this);
        $message->formSentence($this->believes, $this);
        $message->formSentence($this->aLargeGroup, $this);
        $message->formSentence($this->aSeriousConversation, $this);

        $this->personality = $message->message;
    }

    private function createRandomBackstory()
    {
        CharacterBackgroundTraits::init();

        $this->born = CharacterBackgroundTraits::getRandomTrait("born", $this);
        $this->fatherWas = CharacterBackgroundTraits::getRandomTrait("fatherWas", $this);
        $this->motherWas = CharacterBackgroundTraits::getRandomTrait("motherWas", $this);
        $this->notableParentWas = CharacterBackgroundTraits::getRandomTrait("notableParentWas", $this);
        $this->notableParent = rand(0, 1) === 0 ? "father" : "mother";
        $this->graduated = CharacterBackgroundTraits::getRandomTrait("graduated", $this);
        $this->teachersReportsSay = CharacterBackgroundTraits::getRandomTrait("teachersReportsSay", $this);
        $this->furtherEductation = CharacterBackgroundTraits::getRandomTrait("furtherEductation", $this);
        $this->citation = CharacterBackgroundTraits::getRandomTrait("citation", $this);
        $this->commendation = CharacterBackgroundTraits::getRandomTrait("commendation", $this);
        $this->wasSoBoredThey = CharacterBackgroundTraits::getRandomTrait("wasSoBoredThey", $this);

        $message = new MessageFormer();
        $message->formSentence($this->born, $this);
        $message->formSentence($this->fatherWas, $this);
        $message->formSentence($this->motherWas, $this);
        $message->formSentence($this->notableParentWas, $this);
        $message->formSentence($this->graduated, $this);
        $message->formSentence($this->teachersReportsSay, $this);
        $message->formSentence($this->furtherEductation, $this);
        $message->formSentence($this->citation, $this);
        $message->formSentence($this->commendation, $this);
        $message->formSentence($this->wasSoBoredThey, $this);

        $this->backstory = $message->message;
    }
}
