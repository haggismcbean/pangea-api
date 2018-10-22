<?php

namespace App\Traits\PlantTraits;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Traits;
use Carbon\Carbon;

class PlantAppearanceTraits extends Model
{
    private static $defaultLayout = "It has {{value}} {{key}}";

    private static $pureSeedArray = ["{{seedSize}} {{seedShape}} seeds wrapped in a leathery skin", "{{seedSize}} {{seedShape}} {{seedColor}} dots clustered under the leaf", "small {{seedShape}} seeds inside a {{seedSize}} {{seedColor}} {{seedPattern}} pod"];
    private static $fruitSeedArray = ["{{seedSize}} {{seedShape}} seeds inside a {{fruitSize}} {{fruitColor}} {{fruitShape}} shaped fruit", "{{seedSize}} {{seedShape}} seeds inside a {{fruitSize}} {{fruitColor}} {{fruitShape}} shaped nut"];
    private static $grassSeedArray = ["{{seedSize}} {{seedShape}} seeds", "{{seedColor}} seeds wrapped inside a thin leaf", "A frond of {{seedSize}} seeds"];
    private static $seed;
    private static $seedDefaultLayout = "It has {{value}}";

    private static $flowerArray = ["{{flowerColorModifier}} {{flowerColor}}", "{{flowerShape}} {{flowerColor}}", "{{flowerShape}} {{flowerColorModifier}} {{flowerColor}}", "{{flowerSize}} {{flowerColor}}"];
    private static $flower;
    private static $flowerDefaultLayout = "It has {{value}} flowers";

    private static $outerStalkArray = [];
    private static $outerStalk;
    private static $outerStalkDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $innerStalkArray = [];
    private static $innerStalk;
    private static $innerStalkDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $leafArray = ["{{leafColourModifier}} {{leafColor}} {{leafShape}} leaves with heavy veins", "{{leafColourModifier}} {{leafColor}} {{leafShape}} leaves with heavy veins", "{{leafShape}} {{leafColor}} leaves"];
    private static $leaf;
    private static $leafDefaultLayout = "It has {{value}}";

    public static function init()
    {
        // So each location will have a log of how many of each plant it has, the average maturity of the stock. The average age will increase/reduce based on whether people plant, harvest, or time elapses. In that way we kind of keep track of the ages without individually recording each plant's age. It's a bit of a hack which means in theory people will be able to harvest a plant that doesn't exist. We'll limit people to only be able to harvest really old plants if the stock is really big somehow.
        $traits = [
            'flower', 'leaf'//, 'outerStalk', 'innerStalk', 'leaf'
        ];

        foreach( $traits as $trait) {
            PlantAppearanceTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';
            $defaultLayout = $trait . 'DefaultLayout';

            if (property_exists(new PlantAppearanceTraits, $defaultLayout)) {
                PlantAppearanceTraits::${$trait}->defaultLayout = PlantAppearanceTraits::${$defaultLayout};
            } else if (property_exists(new PlantAppearanceTraits, 'defaultLayout')) {
                PlantAppearanceTraits::${$trait}->defaultLayout = PlantAppearanceTraits::$defaultLayout;
            }

            PlantAppearanceTraits::${$trait}->addTraitProperties(
                PlantAppearanceTraits::${$traitArray},
                function($location) {
                    return 1;
                }
            );
        }

        PlantAppearanceTraits::$seed = new Traits("seed");
        PlantAppearanceTraits::$seed->defaultLayout = PlantAppearanceTraits::$seedDefaultLayout;

        PlantAppearanceTraits::$seed->addTraitProperties(
            PlantAppearanceTraits::$pureSeedArray,
            function($plant) {
                if ($plant->hasFruit == 1 || $plant->isGrass == 1) {
                    return 0;
                }

                return 1;
            }
        );

        PlantAppearanceTraits::$seed->addTraitProperties(
            PlantAppearanceTraits::$fruitSeedArray,
            function($plant) {
                if ($plant->hasFruit) {
                    return 1;
                }

                return 0;
            }
        );

        PlantAppearanceTraits::$seed->addTraitProperties(
            PlantAppearanceTraits::$grassSeedArray,
            function($plant) {
                if ($plant->isGrass) {
                    return 1;
                }

                return 0;
            }
        );
    }

    public static function getRandomTrait($traitName, $plant)
    {
        $trait = PlantAppearanceTraits::$$traitName;
        return $trait->getRandomTrait($plant);
    }
}
