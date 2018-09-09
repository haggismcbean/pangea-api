<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CharacterTraits extends Model
{
    // These descriptors must fit in the sentence 'He has $value $keys'
    private static $pronoun = ["he", "she"];
    // Eg: 'He has `full blushing` `cheeks`'
    private static $cheeksTypes = ["full rosy", "sunken", "pointy", "heart shaped"];
    private static $jawTypes = ["a full", "a round", "an oval", "a sunken", "a pointy"];
    private static $skinColours = ["white", "pale pink", "tanned", "pale brown", "brown", "dark brown", "black"];
    private static $skinTypes = ["clean", "greasy", "spotty", "pockmarked", "peeling"];
    private static $skinHairiness = ["hairy", "hairless", "patchy"];
    private static $hairColours = ["brown", "dark brown", "pale brown", "blonde", "black", "ginger"];
    private static $hairTypes = ["curly", "stright", "wavy", "frizzy"];
    private static $noseShapes = ["a big", "a small", "a roman", "a proud", "a crooked"];
    private static $mouthShapes = ["an almond shaped", "a full", "a thin lipped", "a chapped"];
    private static $eyesColours = ["blue", "brown", "dark brown", "green", "yellow", "pale blue", "hazel"];
    private static $eyesTypes = ["wide staring", "narrow", "almond shaped"];
    private static $eyebrowsTypes = ["arched", "flat", "hairy", "thin"];

    public static function getRandomTrait($traitName)
    {
        $trait = CharacterTraits::$$traitName;

        if ($trait) {
            $max = count($trait) - 1;
            return rand(0, $max);
        }

        return "error!";
    }
}
