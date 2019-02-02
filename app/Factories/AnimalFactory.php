<?php

namespace App\Factories;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\AnimalTraits\PredatorMammalAppearanceTraits;
use App\MessageFormer\MessageFormer;
use App\Names\ColorFactory;
use App\Names\SizeFactory;

class AnimalFactory extends Model
{
    public $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;

        $this->createRandomAnimalAppearance($type);
    }

    private function createRandomAnimalAppearance($type)
    {
        PredatorMammalAppearanceTraits::init();

        $this->furAppearance = PredatorMammalAppearanceTraits::getRandomTrait("fur", $this);
        $this->furLustre = "shaggy";
        $this->furColour = "yellow";
        $this->furLength = "long";
        $message = new MessageFormer();
        $message->formSentence($this->furAppearance, $this);
        $this->furAppearance = $message->message;

        $this->legAppearance = PredatorMammalAppearanceTraits::getRandomTrait("legs", $this);
        $this->legCount = "four";
        $this->legLength = "long";
        $message = new MessageFormer();
        $message->formSentence($this->legAppearance, $this);
        $this->legAppearance = $message->message;

        // opening line
        
        // mammal

        // bird

        // amphibian

        // reptile

        // fish
    }
}
