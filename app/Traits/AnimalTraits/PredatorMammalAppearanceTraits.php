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

    private static $postureArray = ["It holds itself low to the ground {{personality}}", "It holds itself {{personality}}", "It scurries around {{personality}}", "It slinks back and forth {{personality}}", "Its tail swishes {{personality}}", "It blinks {{personality}}", "It licks its lips {{personality}}", "Its ears flick {{personality}}"];
    private static $posture;
    private static $postureDefaultLayout = "{{value}}";

    public static function init()
    {
        $traits = [
            'fur', 'legs', 'posture'
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
