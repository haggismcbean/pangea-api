<?php

namespace App\Traits\AnimalTraits;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Traits;
use Carbon\Carbon;

class PreyBirdAppearanceTraits extends Model
{
    private static $defaultLayout = "It has {{value}} {{key}}";

    // private static $legsArray = ["{{legCount}}", "{{legLength}}"];
    // private static $legs;
    // private static $legsDefaultLayout = "It is a {{value}} legged beast";

    private static $feathersArray = ["It has {{featherColour}} {{featherColour}} feathers", "It has {{featherLength}} {{featherColour}} feathers", "It has {{featherLength}} {{featherLustre}} {{featherColour}} feathers"];
    private static $feathers;
    private static $feathersDefaultLayout = "{{value}}";

    private static $postureArray = ["It hops around {{personality}}", "It holds itself {{personality}}", "It scurries around {{personality}}", "It flitters around {{personality}}", "Its flutters around {{personality}}", "It blinks {{personality}}", "It chirrups {{personality}}", "Its squawks {{personality}}"];
    private static $posture;
    private static $postureDefaultLayout = "{{value}}";

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
            'feathers', 'legs', 'posture'
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
