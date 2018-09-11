<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CharacterAppearanceTraits extends Model
{
    // These descriptors must fit in the sentence 'He has $value $keys'
    // Eg: 'He has `full blushing` `cheeks`'
    private static $skinColoursArray = ["white", "pale pink", "tanned", "pale brown", "brown", "dark brown", "black"];
    private static $skinColours;

    private static $cheeksTypesArray = ["full rosy", "sunken", "pointy", "heart shaped", "blushing", "puffy"];
    private static $cheeksTypes;

    private static $jawTypesArray = ["a full", "a round", "an oval", "a sunken", "a pointy", "a protruding"];
    private static $jawTypes;

    private static $skinTypesArray = ["clean", "greasy", "spotty", "pockmarked", "peeling", "rash covered"];
    private static $skinTypes;

    private static $skinHairinessArray = ["hairy", "hairless", "patchy"];
    private static $skinHairiness;

    private static $hairColoursArray = ["brown", "dark brown", "pale brown", "blonde", "black", "ginger"];
    private static $hairColours;

    private static $hairTypesArray = ["curly", "stright", "wavy", "frizzy"];
    private static $hairTypes;

    private static $noseShapesArray = ["a big", "a small", "a roman", "a proud", "a crooked"];
    private static $noseShapes;

    private static $mouthShapesArray = ["an almond shaped", "a full", "a thin lipped", "a chapped"];
    private static $mouthShapes;

    private static $eyesColoursArray = ["blue", "brown", "dark brown", "green", "yellow", "pale blue", "hazel"];
    private static $eyesColours;

    private static $eyesTypesArray = ["wide staring", "narrow", "almond shaped", "suspicious looking", "flirtatious", "permanently shocked", "worried", "care worn", "bottomless"];
    private static $eyesTypes;

    private static $eyebrowsTypesArray = ["arched", "flat", "hairy", "thin"];
    private static $eyebrowsTypes;

    public static function init()
    {
        $traits = [
            'skinColours', 'cheeksTypes', 'jawTypes', 'skinTypes', 'skinHairiness', 'hairColours',
            'hairTypes', 'noseShapes', 'mouthShapes', 'eyesColours', 'eyesTypes', 'eyebrowsTypes'
        ];

        foreach( $traits as $trait) {
            CharacterAppearanceTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';

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
