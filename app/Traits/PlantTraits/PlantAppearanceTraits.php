<?php

namespace App\Traits\PlantTraits;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Traits;
use Carbon\Carbon;

class PlantAppearanceTraits extends Model
{
    private static $defaultLayout = "It has {{value}} {{key}}";

    private static $pureSeedArray = ["{{size}} {{shape}} seeds wrapped in a leathery skin", "{{size}} {{shape}} {{color}} dots hanging under the leaf", "small {{shape}} seeds inside a large {{color}} {{pattern}} pod"];
    private static $fruitSeedArray = ["{{size}} {{shape}} seeds inside a {{size}} {{color}} {{shape}} shaped fruit", "{{size}} {{shape}} seeds inside a {{size}} {{color}} {{shape}} shaped nut"];
    private static $grassSeedArray = ["{{size}} {{shape}} seeds arrayed on the top of the spikelet at the top of the stalk", "{{color}} seeds wrapped inside a thin layer of plant at the top of the plant", "{{size}} seeds in a frond at the top of the plant"];
    private static $seed;
    private static $seedDefaultLayout = "It has {{value}}";

    private static $flowerColorArray = [];
    private static $flowerColor;
    private static $flowerColorDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $flowerArray = [];
    private static $flower;
    private static $flowerDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $outerStalkArray = [];
    private static $outerStalk;
    private static $outerStalkDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $innerStalkArray = [];
    private static $innerStalk;
    private static $innerStalkDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $leafBudArray = [];
    private static $leafBud;
    private static $leafBudDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $leafColorArray = [];
    private static $leafColor;
    private static $leafColorDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $leafAutumColorArray = [];
    private static $leafAutumColor;
    private static $leafAutumColorDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $leafArray = [];
    private static $leaf;
    private static $leafDefaultLayout = "{{pronoun}} has {{value}} skin";

    public static function init()
    {
        // So each location will have a log of how many of each plant it has, the average maturity of the stock. The average age will increase/reduce based on whether people plant, harvest, or time elapses. In that way we kind of keep track of the ages without individually recording each plant's age. It's a bit of a hack which means in theory people will be able to harvest a plant that doesn't exist. We'll limit people to only be able to harvest really old plants if the stock is really big somehow.
        $traits = [
            'seed'//, 'flower', 'outerStalk', 'innerStalk', 'leaf'
        ];

        // foreach( $traits as $trait) {
        //     PlantAppearanceTraits::${$trait} = new Traits($trait);
        //     $traitArray = $trait . 'Array';
        //     $defaultLayout = $trait . 'DefaultLayout';

        //     if (property_exists(new PlantAppearanceTraits, $defaultLayout)) {
        //         PlantAppearanceTraits::${$trait}->defaultLayout = PlantAppearanceTraits::${$defaultLayout};
        //     } else if (property_exists(new PlantAppearanceTraits, 'defaultLayout')) {
        //         PlantAppearanceTraits::${$trait}->defaultLayout = PlantAppearanceTraits::$defaultLayout;
        //     }

        //     PlantAppearanceTraits::${$trait}->addTraitProperties(
        //         PlantAppearanceTraits::${$traitArray},
        //         function($location) {
        //             return 1;
        //         }
        //     );
        // }

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
        return $trait->getRandomTrait($plant)->trait;
    }
}
