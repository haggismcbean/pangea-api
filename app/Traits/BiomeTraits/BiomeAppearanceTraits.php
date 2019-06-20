<?php

namespace App\Traits\BiomeTraits;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Traits;
use Carbon\Carbon;

class BiomeAppearanceTraits extends Model
{
    private static $defaultLayout = "It has {{value}} {{key}}";

    private static $introArray = ["You awaken"];
    private static $intro;
    private static $introDefaultLayout = "{{value}}";

    private static $farNatureArray = ["In the distance, something {{sound}}. From the other side, something {{sound}} back", "You disturb a creature of some sort - it runs away {{soundAction}} loudly but you do not catch a glimpse of it", "You see a flock of birds flapping labouredly, low across the sky", "In the distance you hear what sounds like a baby animal calling. Then it goes silent", "A solitary bird flaps away"];
    private static $farNature;
    private static $farNatureDefaultLayout = "{{value}}";

    private static $closeNatureArray = ["Close to where you're sat, you can hear the insects. Great {{colour}} {{flyingInsectType}} whose wings flap plastically as they bumble from leaf to leaf", "By your head you hear a {{crawlingInsectType}} scuttling about"];
    private static $closeNature;
    private static $closeNatureDefaultLayout = "{{value}}";

    private static $droneArray = ["The drone floats silently above you", "Above you, a drone floats silently. Watching your every move, converting it into textfeed, and beaming it back, straight into the skulls of the people of the homeworld", "You notice the drone floating a way off, as if to give you some privacy", "You notice an absence. At first you don't know what's causing it, and then you realise, the drone is gone. Just as you are getting used to the idea, it finds its way back to you, floating over lazily from elsewhere", "The drone circles you", "A red light is shining under the drone's eye. You wonder if someone is watching you right now"];
    private static $drone;
    private static $droneDefaultLayout = "{{value}}";

    public static function init()
    {
        $traits = [
            'intro', 'farNature', 'closeNature', 'drone'
        ];

        foreach( $traits as $trait) {
            BiomeAppearanceTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';
            $defaultLayout = $trait . 'DefaultLayout';

            if (property_exists(new BiomeAppearanceTraits, $defaultLayout)) {
                BiomeAppearanceTraits::${$trait}->defaultLayout = BiomeAppearanceTraits::${$defaultLayout};
            } else if (property_exists(new BiomeAppearanceTraits, 'defaultLayout')) {
                BiomeAppearanceTraits::${$trait}->defaultLayout = BiomeAppearanceTraits::$defaultLayout;
            }

            BiomeAppearanceTraits::${$trait}->addTraitProperties(
                BiomeAppearanceTraits::${$traitArray},
                function($location) {
                    return 1;
                }
            );
        }
    }

    public static function getRandomTrait($traitName, $biome)
    {
        $trait = BiomeAppearanceTraits::$$traitName;

        return $trait->getRandomTrait($biome);
    }
}
