<?php

namespace App\Traits\WeatherTraits;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Traits;
use Carbon\Carbon;

class WeatherTraits extends Model
{
    private static $defaultLayout = "It has {{value}} {{key}}";

    private static $temperatureArray = ["{{biomeName}}"];
    private static $temperature;
    private static $temperatureDefaultLayout = "You find yourself in a {{value}}";

    private static $rainArray = ["There are {{count}} other people here. They seem {{relativeWealth}} - one of them is {{wealthMarker}}. You {{closeness}} them."];
    private static $rain;
    private static $rainDefaultLayout = "{{value}}";

    private static $snowArray = ["A {{birdDescription}} bird {{sound}}s at you {{personality}} from a nearby {{physicalFeature}}", "It is eerily quiet", "A fly buzzes by your ear"];
    private static $snow;
    private static $snowDefaultLayout = "{{value}}";

    private static $visibilityArray = ["It is a {{temperature}} day.", "There's a {{windStrength}} wind blowing in from the {{windDirection}}"];
    private static $visibilityDescription;
    private static $visibilityDefaultLayout = "It is a {{value}} legged herbivore";

    private static $windArray = ["It is a {{temperature}} day.", "There's a {{windStrength}} wind blowing in from the {{windDirection}}"];
    private static $windDescription;
    private static $windDefaultLayout = "It is a {{value}} legged herbivore";

    public static function init()
    {
        $traits = [
            'temperature', 'rain', 'snow', 'visibility', 'wind'
        ];

        foreach( $traits as $trait) {
            WeatherTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';
            $defaultLayout = $trait . 'DefaultLayout';

            if (property_exists(new WeatherTraits, $defaultLayout)) {
                WeatherTraits::${$trait}->defaultLayout = WeatherTraits::${$defaultLayout};
            } else if (property_exists(new WeatherTraits, 'defaultLayout')) {
                WeatherTraits::${$trait}->defaultLayout = WeatherTraits::$defaultLayout;
            }

            WeatherTraits::${$trait}->addTraitProperties(
                WeatherTraits::${$traitArray},
                function($location) {
                    return 1;
                }
            );
        }
    }

    public static function getRandomTrait($traitName, $biome)
    {
        $trait = WeatherTraits::$$traitName;
        return $trait->getRandomTrait($biome);
    }
}
