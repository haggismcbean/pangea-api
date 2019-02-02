<?php

namespace App\Traits\AnimalTraits;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Traits;
use Carbon\Carbon;

class PredatorMammalAppearanceTraits extends Model
{
    private static $defaultLayout = "It has {{value}} {{key}}";

    private static $legsArray = ["{{legCount}}", "{{legLength}}"];
    private static $legs;
    private static $legsDefaultLayout = "It is a {{value}} legged beast";

    private static $furArray = ["It has {{furLustre}} {{furColour}} fur", "It has {{furLength}} {{furColour}} fur", "It has {{furLength}} {{furLustre}} {{furColour}} fur"];
    private static $fur;
    private static $furDefaultLayout = "{{value}}";

    // private static $feetArray = [];
    // private static $feet;
    // private static $feetDefaultLayout = "{{pronoun}} has {{value}} skin";

    // private static $earsArray = [];
    // private static $ears;
    // private static $earsDefaultLayout = "{{pronoun}} has {{value}} skin";

    // private static $headArray = ["{{leafColourModifier}} {{leafColor}} {{leafShape}} leaves with heavy veins", "{{leafColourModifier}} {{leafColor}} {{leafShape}} leaves with heavy veins", "{{leafShape}} {{leafColor}} leaves"];
    // private static $head;
    // private static $headDefaultLayout = "It has {{value}}";

    // private static $tailArray = ["{{leafColourModifier}} {{leafColor}} {{leafShape}} leaves with heavy veins", "{{leafColourModifier}} {{leafColor}} {{leafShape}} leaves with heavy veins", "{{leafShape}} {{leafColor}} leaves"];
    // private static $tail;
    // private static $tailDefaultLayout = "It has {{value}}";

    public static function init()
    {
        $traits = [
            'fur', 'legs'
            // , 'feet', 'ears', 'head', 'tail'
        ];

        foreach( $traits as $trait) {
            PredatorMammalAppearanceTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';
            $defaultLayout = $trait . 'DefaultLayout';

            if (property_exists(new PredatorMammalAppearanceTraits, $defaultLayout)) {
                PredatorMammalAppearanceTraits::${$trait}->defaultLayout = PredatorMammalAppearanceTraits::${$defaultLayout};
            } else if (property_exists(new PredatorMammalAppearanceTraits, 'defaultLayout')) {
                PredatorMammalAppearanceTraits::${$trait}->defaultLayout = PredatorMammalAppearanceTraits::$defaultLayout;
            }

            PredatorMammalAppearanceTraits::${$trait}->addTraitProperties(
                PredatorMammalAppearanceTraits::${$traitArray},
                function($location) {
                    return 1;
                }
            );
        }
    }

    public static function getRandomTrait($traitName, $animal)
    {
        $trait = PredatorMammalAppearanceTraits::$$traitName;
        return $trait->getRandomTrait($animal);
    }
}
