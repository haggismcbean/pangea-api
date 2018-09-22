<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CharacterAppearanceTraits extends Model
{
    private static $defaultLayout = "{{pronoun}} has {{value}} {{key}}";

    private static $skinColoursArray = ["snow white", "pale pink", "healthy tanned", "tree brown", "tea brown", "mahogany brown", "black"];
    private static $skinColours;
    private static $skinColoursDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $cheeksTypesArray = ["full rosy", "sunken", "pointy", "heart shaped", "blushing", "puffy"];
    private static $cheeksTypes;
    private static $cheeksTypesDefaultLayout = "{{pronoun}} has {{value}} cheeks";

    private static $jawTypesArray = ["a full", "a round", "an oval", "a sunken", "a pointy", "a protruding"];
    private static $jawTypes;
    private static $jawTypesDefaultLayout = "{{pronoun}} has {{value}} jaw";

    private static $skinTypesArray = ["clean", "greasy", "spotty", "pockmarked", "peeling", "rash covered"];
    private static $skinTypes;
    private static $skinTypesDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $skinHairinessArray = ["hairy", "hairless", "patchy"];
    private static $skinHairiness;
    private static $skinHairinessDefaultLayout = "{{pronoun}} has {{value}} skin";

    private static $hairColoursArray = ["brown", "dark brown", "pale brown", "blonde", "black", "ginger"];
    private static $hairColours;
    private static $hairColoursDefaultLayout = "{{pronoun}} has {{value}} hair";

    private static $hairTypesArray = ["curly", "stright", "wavy", "frizzy"];
    private static $hairTypes;
    private static $hairTypesDefaultLayout = "{{pronoun}} has {{value}} hair";

    private static $noseShapesArray = ["a big", "a small", "a roman", "a proud", "a crooked"];
    private static $noseShapes;
    private static $noseShapesDefaultLayout = "{{pronoun}} has {{value}} nose";

    private static $mouthShapesArray = ["an almond shaped", "a full", "a thin lipped", "a chapped"];
    private static $mouthShapes;
    private static $mouthShapesDefaultLayout = "{{pronoun}} has {{value}} mouth";

    private static $eyesColoursArray = ["weepy blue", "cold blue", "sludge brown", "dark brown", "slime green", "firey yellow", "pale blue", "solid hazel", "dull grey"];
    private static $eyesColours;
    private static $eyesColoursDefaultLayout = "{{pronoun}} has {{value}} eyes";

    private static $eyesTypesArray = ["wide staring", "narrow", "almond shaped", "suspicious looking", "flirtatious", "permanently shocked", "worried", "care worn", "bottomless"];
    private static $eyesTypes;
    private static $eyesTypesDefaultLayout = "{{pronoun}} has {{value}} eyes";

    private static $eyebrowsTypesArray = ["arched", "flat", "hairy", "thin"];
    private static $eyebrowsTypes;
    private static $eyebrowsTypesDefaultLayout = "{{pronoun}} has {{value}} eyebrows";

    public static function init()
    {
        $traits = [
            'skinColours', 'cheeksTypes', 'jawTypes', 'skinTypes', 'skinHairiness', 'hairColours',
            'hairTypes', 'noseShapes', 'mouthShapes', 'eyesColours', 'eyesTypes', 'eyebrowsTypes'
        ];

        foreach( $traits as $trait) {
            CharacterAppearanceTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';
            $defaultLayout = $trait . 'DefaultLayout';

            if (property_exists(new CharacterAppearanceTraits, $defaultLayout)) {
                CharacterAppearanceTraits::${$trait}->defaultLayout = CharacterAppearanceTraits::${$defaultLayout};
            } else if (property_exists(new CharacterAppearanceTraits, 'defaultLayout')) {
                CharacterAppearanceTraits::${$trait}->defaultLayout = CharacterAppearanceTraits::$defaultLayout;
            }

            CharacterAppearanceTraits::${$trait}->addTraitProperties(
                CharacterAppearanceTraits::${$traitArray},
                function($character) {
                    return 1;
                }
            );
        }
    }

    public static function getRandomTrait($traitName, $character)
    {
        $trait = CharacterAppearanceTraits::$$traitName;
        return $trait->getRandomTrait($character);
    }
}
