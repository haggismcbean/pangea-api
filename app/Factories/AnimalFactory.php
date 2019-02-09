<?php

namespace App\Factories;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Traits\AnimalTypes\PredatorMammal;
use App\Traits\AnimalTypes\PreyBird;
use App\Traits\AnimalTypes\Deer;
use App\Traits\AnimalTypes\Fish;

use App\Traits\AnimalTraits\PredatorMammalAppearanceTraits;
use App\Traits\AnimalTraits\PreyBirdAppearanceTraits;
use App\Traits\AnimalTraits\DeerAppearanceTraits;
use App\Traits\AnimalTraits\FishAppearanceTraits;

use App\MessageFormer\MessageFormer;
use App\Names\ColorFactory;
use App\Names\SizeFactory;
use App\Names\TextureFactory;
use App\Names\PersonalityFactory;

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
        if ($type == "predator-mammal") {
            $this->stats = new PredatorMammal();
            PredatorMammalAppearanceTraits::init();

            $this->furAppearance = PredatorMammalAppearanceTraits::getRandomTrait("fur", $this);
            $this->furLustre = TextureFactory::getRandomLustre();
            $this->furColour = ColorFactory::getRandomFurColor();
            $this->furLength = SizeFactory::getRandomHairLength();
            $message = new MessageFormer();
            $message->formSentence($this->furAppearance, $this);
            $this->furAppearance = $message->message;

            $this->legAppearance = PredatorMammalAppearanceTraits::getRandomTrait("legs", $this);
            $this->legCount = "four";
            $this->legLength = SizeFactory::getRandomRodLength();
            $message = new MessageFormer();
            $message->formSentence($this->legAppearance, $this);
            $this->legAppearance = $message->message;

            $this->postureAppearance = PredatorMammalAppearanceTraits::getRandomTrait("posture", $this);
            $this->personality = PersonalityFactory::getRandomManner();
            $message = new MessageFormer();
            $message->formSentence($this->postureAppearance, $this);
            $this->postureAppearance = $message->message;
        }

        if ($type == "prey-bird") {
            $this->stats = new PreyBird();
            PreyBirdAppearanceTraits::init();

            $this->feathersAppearance = PreyBirdAppearanceTraits::getRandomTrait("feathers", $this);
            $this->feathersLustre = TextureFactory::getRandomLustre();
            $this->feathersColour = ColorFactory::getRandomFurColor();
            $this->feathersLength = SizeFactory::getRandomHairLength();
            $message = new MessageFormer();
            $message->formSentence($this->feathersAppearance, $this);
            $this->feathersAppearance = $message->message;

            $this->legAppearance = PreyBirdAppearanceTraits::getRandomTrait("legs", $this);
            $this->legCount = "two";
            $this->legLength = SizeFactory::getRandomRodLength();
            $message = new MessageFormer();
            $message->formSentence($this->legAppearance, $this);
            $this->legAppearance = $message->message;

            $this->postureAppearance = PreyBirdAppearanceTraits::getRandomTrait("posture", $this);
            $this->personality = PersonalityFactory::getRandomManner();
            $message = new MessageFormer();
            $message->formSentence($this->postureAppearance, $this);
            $this->postureAppearance = $message->message;
        }

        if ($type == "deer") {
            $this->stats = new Deer();
            DeerAppearanceTraits::init();

            $this->furAppearance = DeerAppearanceTraits::getRandomTrait("fur", $this);
            $this->furLustre = TextureFactory::getRandomLustre();
            $this->furColour = ColorFactory::getRandomFurColor();
            $this->furLength = SizeFactory::getRandomHairLength();
            $message = new MessageFormer();
            $message->formSentence($this->furAppearance, $this);
            $this->furAppearance = $message->message;

            $this->legAppearance = DeerAppearanceTraits::getRandomTrait("legs", $this);
            $this->legCount = "four";
            $this->legLength = SizeFactory::getRandomRodLength();
            $message = new MessageFormer();
            $message->formSentence($this->legAppearance, $this);
            $this->legAppearance = $message->message;

            $this->postureAppearance = DeerAppearanceTraits::getRandomTrait("posture", $this);
            $this->personality = PersonalityFactory::getRandomManner();
            $message = new MessageFormer();
            $message->formSentence($this->postureAppearance, $this);
            $this->postureAppearance = $message->message;

            if ($this->stats->hasHorn) {
                $this->hornAppearance = DeerAppearanceTraits::getRandomTrait("horn", $this);
                $this->size = SizeFactory::getRandomSize();
                $message = new MessageFormer();
                $message->formSentence($this->hornAppearance, $this);
                $this->hornAppearance = $message->message;
            }
        }

        if ($type == "fish") {
            $this->stats = new Fish();
            FishAppearanceTraits::init();

            $this->scalesAppearance = FishAppearanceTraits::getRandomTrait("scales", $this);
            $this->shape = SizeFactory::getRandomShape();
            $this->lustre = TextureFactory::getRandomLustre();
            $this->colour = ColorFactory::getRandomColor();
            $message = new MessageFormer();
            $message->formSentence($this->scalesAppearance, $this);
            $this->scalesAppearance = $message->message;

            $this->postureAppearance = FishAppearanceTraits::getRandomTrait("posture", $this);
            $this->shape = SizeFactory::getRandomShape();
            $message = new MessageFormer();
            $message->formSentence($this->postureAppearance, $this);
            $this->postureAppearance = $message->message;
        }

        // hog

        // rodent

        // monkey

        // fish

        // snake

        // lizard
    }
}
