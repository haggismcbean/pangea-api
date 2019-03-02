<?php

namespace App\Factories;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Traits\BiomeTraits\BiomeAppearanceTraits;
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
        $this->colour = "Red";
        $this->flyingInsectType = "bee";
        $this->crawlingInsectType = "beetle";

        $this->biome = BiomeAppearanceTraits::getRandomTrait("intro", $this);
        $message = new MessageFormer();
        $message->formSentence($this->biome, $this);
        $this->biome = $message->message;

        $this->farNature = BiomeAppearanceTraits::getRandomTrait("farNature", $this);
        $message = new MessageFormer();
        $message->formSentence($this->farNature, $this);
        $this->farNature = $message->message;

        $this->wildlife = BiomeAppearanceTraits::getRandomTrait("closeNature", $this);
        $message = new MessageFormer();
        $message->formSentence($this->wildlife, $this);
        $this->wildlife = $message->message;

        $this->weatherDescription = BiomeAppearanceTraits::getRandomTrait("drone", $this);
        $message = new MessageFormer();
        $message->formSentence($this->weatherDescription, $this);
        $this->weatherDescription = $message->message;
    }
}
