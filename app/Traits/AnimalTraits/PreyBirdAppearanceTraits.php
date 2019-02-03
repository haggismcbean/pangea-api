<?php

namespace App\Traits\AnimalTraits;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Traits;
use Carbon\Carbon;

class PreyBirdAppearanceTraits extends Model
{
    private static $defaultLayout = "It has {{value}} {{key}}";

    private static $legsArray = ["{{legCount}}", "{{legLength}}"];
    private static $legs;
    private static $legsDefaultLayout = "It is a {{value}} legged bird";

    private static $feathersArray = ["It has {{feathersLustre}} {{feathersColour}} feathers", "It has {{feathersLength}} {{feathersColour}} feathers", "It has {{feathersLength}} {{feathersLustre}} {{feathersColour}} feathers"];
    private static $feathers;
    private static $feathersDefaultLayout = "{{value}}";

    private static $postureArray = ["It hops around {{personality}}", "It holds itself {{personality}}", "It scurries around {{personality}}", "It flitters around {{personality}}", "Its flutters around {{personality}}", "It blinks {{personality}}", "It chirrups {{personality}}", "Its squawks {{personality}}"];
    private static $posture;
    private static $postureDefaultLayout = "{{value}}";

    public static function init()
    {
        $traits = [
            'feathers', 'legs', 'posture'
        ];

        foreach( $traits as $trait) {
            PreyBirdAppearanceTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';
            $defaultLayout = $trait . 'DefaultLayout';

            if (property_exists(new PreyBirdAppearanceTraits, $defaultLayout)) {
                PreyBirdAppearanceTraits::${$trait}->defaultLayout = PreyBirdAppearanceTraits::${$defaultLayout};
            } else if (property_exists(new PreyBirdAppearanceTraits, 'defaultLayout')) {
                PreyBirdAppearanceTraits::${$trait}->defaultLayout = PreyBirdAppearanceTraits::$defaultLayout;
            }

            PreyBirdAppearanceTraits::${$trait}->addTraitProperties(
                PreyBirdAppearanceTraits::${$traitArray},
                function($location) {
                    return 1;
                }
            );
        }
    }

    public static function getRandomTrait($traitName, $animal)
    {
        $trait = PreyBirdAppearanceTraits::$$traitName;
        return $trait->getRandomTrait($animal);
    }
}
