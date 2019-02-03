<?php

namespace App\Traits\AnimalTraits;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Traits;
use Carbon\Carbon;

class DeerAppearanceTraits extends Model
{
    private static $defaultLayout = "It has {{value}} {{key}}";

    private static $legsArray = ["{{legCount}}", "{{legLength}}"];
    private static $legs;
    private static $legsDefaultLayout = "It is a {{value}} legged deer";

    private static $furArray = ["It has {{furLustre}} {{furColour}} fur", "It has {{furLength}} {{furColour}} fur", "It has {{furLength}} {{furLustre}} {{furColour}} fur"];
    private static $fur;
    private static $furDefaultLayout = "{{value}}";

    private static $postureArray = ["It holds itself low to the ground {{personality}}", "It holds itself {{personality}}", "It scurries around {{personality}}", "It slinks back and forth {{personality}}", "Its tail swishes {{personality}}", "It blinks {{personality}}", "It licks its lips {{personality}}", "Its ear flicks {{personality}}"];
    private static $posture;
    private static $postureDefaultLayout = "{{value}}";

    private static $hornArray = ["It has {{size}} antlers", "It has a {{size}} twisted horn", "It has two {{size}} curving horns"];
    private static $horn;
    private static $hornDefaultLayout = "{{value}}";

    public static function init()
    {
        $traits = [
            'fur', 'legs', 'posture', 'horn'
        ];

        foreach( $traits as $trait) {
            DeerAppearanceTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';
            $defaultLayout = $trait . 'DefaultLayout';

            if (property_exists(new DeerAppearanceTraits, $defaultLayout)) {
                DeerAppearanceTraits::${$trait}->defaultLayout = DeerAppearanceTraits::${$defaultLayout};
            } else if (property_exists(new DeerAppearanceTraits, 'defaultLayout')) {
                DeerAppearanceTraits::${$trait}->defaultLayout = DeerAppearanceTraits::$defaultLayout;
            }

            DeerAppearanceTraits::${$trait}->addTraitProperties(
                DeerAppearanceTraits::${$traitArray},
                function($location) {
                    return 1;
                }
            );
        }
    }

    public static function getRandomTrait($traitName, $animal)
    {
        $trait = DeerAppearanceTraits::$$traitName;
        return $trait->getRandomTrait($animal);
    }
}
