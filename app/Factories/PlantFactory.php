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
    private $_leafAutumnAppearance;
    public $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        // So each location will have a log of how many of each plant it has, the average age of the stock. The average age will increase/reduce based on whether people plant, harvest, or time elapses. In that way we kind of keep track of the ages without individually recording each plant's age. For plants that are seasonal, it will be pretty bloody accurate. For plants that life over many many years, it will be a bit more hit and miss. It's a bit of a hack which means in theory people will be able to harvest a plant that doesn't exist. We'll limit people to only be able to harvest really old plants if the stock is really big somehow.

        $this->type = $type;

        // $this->seedsStartDate = Carbon::now();
        // $this->seedsEndDate = Carbon::now();
        // $this->flowerStartDate = Carbon::now();
        // $this->flowerEndDate = Carbon::now();
        // $this->leafStartDate = Carbon::now();
        // $this->leafEndDate = Carbon::now();

        // $this->flowerUse = $this->getRandomFlowerUse();
        // $this->seedUse = $this->getRandomSeedUse();
        // $this->outerStalkUse = $this->getRandomOuterStalkUse();
        // $this->innerStalkUse = $this->getRandomInnerStalkUse();
        // $this->leafUse = $this->getRandomLeafUse();

        // We'll have standard weights for things so we don't have to generate and store them for each plant!!
        $this->rotRate = rand(0, 10);

        // sproutAppearance, seedAppearance, flowerAppearance, deathAppearance, outerStalkAppearance, innerStalkAppearance, leafAppearance
        $this->createRandomPlantAppearance($type);
    }

    private function createRandomPlantAppearance($type)
    {
        PlantAppearanceTraits::init();

        // opening line
        
        // seed
        $this->seedAppearance = PlantAppearanceTraits::getRandomTrait("seed", $this);
        $this->seedSize = SizeFactory::getRandomSize();
        $this->seedColor = ColorFactory::getRandomColor();
        $this->seedShape = SizeFactory::getRandomShape();
        $this->seedPattern = ColorFactory::getRandomPattern();
        $message = new MessageFormer();
        $message->formSentence($this->seedAppearance, $this);
        $this->seedAppearance = $message->message;

        // fruit
        if ($this->type->hasFruit) {
            $this->fruitSize = SizeFactory::getRandomSize();
            $this->fruitColor = ColorFactory::getRandomColor();
            $this->fruitShape = SizeFactory::getRandomShape();
            $this->fruitPattern = ColorFactory::getRandomPattern();
        }

        // flower
        if ($this->type->hasFlower) {
            $this->flowerAppearance = PlantAppearanceTraits::getRandomTrait("flower", $this);
            $this->flowerSize = SizeFactory::getRandomSize();
            $this->flowerColor = ColorFactory::getRandomColor();
            $this->flowerShape = SizeFactory::getRandomFlowerShape();
            $this->flowerColourModifier = ColorFactory::getRandomShade();
            $message = new MessageFormer();
            $message->formSentence($this->flowerAppearance, $this);
            $this->flowerAppearance = $message->message;
        }

        // leaf
        // if ($type->leafAppearance) {
            // $this->leafAppearance = $type->leafAppearance;
        // } else {
            $this->leafSize = SizeFactory::getRandomSize();
            $this->leafColor = ColorFactory::getRandomLeafColor();
            $this->leafShape = SizeFactory::getRandomLeafShape();
            $this->leafColourModifier = ColorFactory::getRandomShade();
            $this->leafAppearance = PlantAppearanceTraits::getRandomTrait("leaf", $this);
            $this->_leafAutumnAppearance = $this->leafAppearance;
            $message = new MessageFormer();
            $message->formSentence($this->leafAppearance, $this);
            $this->leafAppearance = $message->message;
        // }
        
        // autumn leaf
        if ($this->type->isSeasonal) {
            $this->leafColor = ColorFactory::getRandomAutumnColor();
            $message = new MessageFormer();
            $message->formSentence($this->_leafAutumnAppearance, $this);
            $this->leafAutumnAppearance = $message->message;
        }

        // todos/other
        // $this->sproutAppearance = PlantAppearanceTraits::getRandomTrait("sprout", $this);
        // $this->deathAppearance = PlantAppearanceTraits::getRandomTrait("death", $this);
        // $this->outerStalkAppearance = PlantAppearanceTraits::getRandomTrait("outerStalk", $this);
        // $this->innerStalkAppearance = PlantAppearanceTraits::getRandomTrait("innerStalk", $this);
    }
}
