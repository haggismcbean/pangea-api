<?php

namespace App\Factories;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Traits\BiomeTraits\BiomeAppearanceTraits;

use App\Names\SoundFactory;
use App\Names\ColorFactory;

use App\MessageFormer\MessageFormer;

class BiomeFactory extends Model
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->createBiomeAppearance();
    }

    private function createBiomeAppearance()
    {
        // so we want to create a message describing the current zone.
        BiomeAppearanceTraits::init();
        
        $message = new MessageFormer();
        $this->colour = ColorFactory::getRandomColor();
        $this->flyingInsectType = "bees";
        $this->crawlingInsectType = "beetle";

        $this->sound = SoundFactory::getRandomAnimalSound();
        $this->soundAction = SoundFactory::getRandomAnimalSoundAction();

        $message = new MessageFormer();
        $this->intro = BiomeAppearanceTraits::getRandomTrait("intro", $this);
        $message->formSentence($this->intro, $this);
        $this->intro = $message->message;

        $message = new MessageFormer();
        $this->farNature = BiomeAppearanceTraits::getRandomTrait("farNature", $this);
        $message->formSentence($this->farNature, $this);
        $this->farNature = $message->message;

        $message = new MessageFormer();
        $this->closeNature = BiomeAppearanceTraits::getRandomTrait("closeNature", $this);
        $message->formSentence($this->closeNature, $this);
        $this->closeNature = $message->message;

        $message = new MessageFormer();
        $this->drone = BiomeAppearanceTraits::getRandomTrait("drone", $this);
        $message->formSentence($this->drone, $this);
        $this->drone = $message->message;
    }
}
