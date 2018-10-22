<?php

namespace App\Factories;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\PlantTraits\PlantAppearanceTraits;
use App\MessageFormer\MessageFormer;
use App\Names\ColorFactory;
use App\Names\SizeFactory;

class PlantFactory extends Model
{
    private $age;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($age = null)
    {
        // So each location will have a log of how many of each plant it has, the average age of the stock. The average age will increase/reduce based on whether people plant, harvest, or time elapses. In that way we kind of keep track of the ages without individually recording each plant's age. For plants that are seasonal, it will be pretty bloody accurate. For plants that life over many many years, it will be a bit more hit and miss. It's a bit of a hack which means in theory people will be able to harvest a plant that doesn't exist. We'll limit people to only be able to harvest really old plants if the stock is really big somehow.

        // TODO - good (weighted) randoms
        $this->maxHeight = rand(0, 1);
        $this->growthRate = rand(0, 1);
        $this->isSeasonal = rand(0, 1) === 1 ? true : false;
        $this->hasFruit = rand(0, 1) === 1 ? true : false;
        $this->isGrass = rand(0, 1) === 1 ? !$this->hasFruit : false;
        // TODO - dates!
        $this->sproutDate = Carbon::now();
        $this->deathDate = Carbon::now();
        $this->seedsStartDate = Carbon::now();
        $this->seedsEndDate = Carbon::now();
        $this->flowerStartDate = Carbon::now();
        $this->flowerEndDate = Carbon::now();
        $this->leafStartDate = Carbon::now();
        $this->leafEndDate = Carbon::now();

        // $this->flowerUse = $this->getRandomFlowerUse();
        // $this->seedUse = $this->getRandomSeedUse();
        // $this->outerStalkUse = $this->getRandomOuterStalkUse();
        // $this->innerStalkUse = $this->getRandomInnerStalkUse();
        // $this->leafUse = $this->getRandomLeafUse();

        // We'll have standard weights for things so we don't have to generate and store them for each plant!!
        $this->rotRate = rand(0, 1);

        // sproutAppearance, seedAppearance, flowerAppearance, deathAppearance, outerStalkAppearance, innerStalkAppearance, leafAppearance
        $this->createRandomPlantAppearance();
    }

    private function createRandomPlantAppearance()
    {
        PlantAppearanceTraits::init();

        // $this->sproutAppearance = PlantAppearanceTraits::getRandomTrait("sprout", $this);
        // $this->seedAppearance = PlantAppearanceTraits::getRandomTrait("seed", $this);
        $this->seedSize = SizeFactory::getRandomSize();
        $this->seedColor = ColorFactory::getRandomColor();
        $this->seedShape = SizeFactory::getRandomShape();
        $this->seedPattern = ColorFactory::getRandomPattern();
        $this->fruitSize = SizeFactory::getRandomSize();
        $this->fruitColor = ColorFactory::getRandomColor();
        $this->fruitShape = SizeFactory::getRandomShape();
        $this->fruitPattern = ColorFactory::getRandomPattern();
        // $message = new MessageFormer();
        // $message->formSentence($this->seedAppearance, $this);
        // $this->seedAppearance = $message->message;
        // $this->flowerAppearance = PlantAppearanceTraits::getRandomTrait("flower", $this);
        $this->flowerSize = SizeFactory::getRandomSize();
        $this->flowerColor = ColorFactory::getRandomColor();
        $this->flowerShape = SizeFactory::getRandomFlowerShape();
        $this->flowerColourModifier = ColorFactory::getRandomShade();
        // $message = new MessageFormer();
        // $message->formSentence($this->flowerAppearance, $this);
        // $this->flowerAppearance = $message->message;
        // $this->deathAppearance = PlantAppearanceTraits::getRandomTrait("death", $this);
        // $this->outerStalkAppearance = PlantAppearanceTraits::getRandomTrait("outerStalk", $this);
        // $this->innerStalkAppearance = PlantAppearanceTraits::getRandomTrait("innerStalk", $this);
        $this->leafSize = SizeFactory::getRandomSize();
        $this->leafColor = ColorFactory::getRandomLeafColor();
        $this->leafShape = SizeFactory::getRandomFlowerShape();
        $this->leafColourModifier = ColorFactory::getRandomShade();
        $this->leafAppearance = PlantAppearanceTraits::getRandomTrait("leaf", $this);
        $this->leafAutumnAppearance = $this->leafAppearance;
        $message = new MessageFormer();
        $message->formSentence($this->leafAppearance, $this);
        $this->leafAppearance = $message->message;

        $this->leafColor = ColorFactory::getRandomAutumnColor();
        $message = new MessageFormer();
        $message->formSentence($this->leafAutumnAppearance, $this);
        $this->leafAutumnAppearance = $message->message;

        // $message->addSentence("{{name}} is a {{gender}}", $this);
        // $message->addSentence("{{pronoun}} is " . $this->age . " years old", $this);
        // $message->addSentence("{{pronoun}} is " . $this->height . "cm tall", $this);
        // $message->addSentence("{{pronoun}} weighs " . $this->weight . "kg", $this);
        // $message->formSentence($this->skin_type, $this);
        // $message->formSentence($this->skin_hairiness, $this);
        // $message->formSentence($this->cheek_type, $this);
        // $message->formSentence($this->jaw_type, $this);
        // $message->formSentence($this->hair_colour, $this);
        // $message->formSentence($this->hair_type, $this);
        // $message->formSentence($this->nose, $this);
        // $message->formSentence($this->mouth, $this);
        // $message->formSentence($this->eye_colour, $this);
        // $message->formSentence($this->eye_type, $this);
        // $message->formSentence($this->eyebrow_type, $this);

        // $this->appearance = $message->message;

        $this->appearance = null;//
        $this->springAppearance = null;//
        $this->summerAppearance = null;//
        $this->autumnAppearance = null;//
        $this->winterAppearance = null;//
    }
}
