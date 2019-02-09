<?php

namespace App\Traits\AnimalTraits;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Traits;
use Carbon\Carbon;

class FishAppearanceTraits extends Model
{
    private static $defaultLayout = "It has {{value}} {{key}}";

    private static $scalesArray = ["It has {{shape}} scales", "It has {{lustre}} {{shape}} scales", "It has {{lustre}} {{colour}} scales"];
    private static $scales;
    private static $scalesDefaultLayout = "{{value}}";

    private static $postureArray = ["It is a {{shape}} fish"];
    private static $posture;
    private static $postureDefaultLayout = "{{value}}";

    public static function init()
    {
        $traits = [
            'scales', 'posture'
        ];

        foreach( $traits as $trait) {
            FishAppearanceTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';
            $defaultLayout = $trait . 'DefaultLayout';

            if (property_exists(new FishAppearanceTraits, $defaultLayout)) {
                FishAppearanceTraits::${$trait}->defaultLayout = FishAppearanceTraits::${$defaultLayout};
            } else if (property_exists(new FishAppearanceTraits, 'defaultLayout')) {
                FishAppearanceTraits::${$trait}->defaultLayout = FishAppearanceTraits::$defaultLayout;
            }

            FishAppearanceTraits::${$trait}->addTraitProperties(
                FishAppearanceTraits::${$traitArray},
                function($location) {
                    return 1;
                }
            );
        }
    }

    public static function getRandomTrait($traitName, $animal)
    {
        $trait = FishAppearanceTraits::$$traitName;
        return $trait->getRandomTrait($animal);
    }
}
