<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CharacterTraits extends Model
{
    public $appearance;

    // These descriptors must fit in the sentence 'He has $value $keys'
    private $pronoun = ["he", "she"];
    // Eg: 'He has `full blushing` `cheeks`'
    private $cheeksTypes = ["full rosy", "sunken", "pointy", "heart shaped"];
    private $jawTypes = ["a full", "a round", "an oval", "a sunken", "a pointy"];
    private $skinColours = ["white", "pale pink", "tanned", "pale brown", "brown", "dark brown", "black"];
    private $skinTypes = ["clean", "greasy", "spotty", "pockmarked", "peeling"];
    private $skinHairiness = ["hairy", "hairless", "patchy"];
    private $hairColours = ["brown", "dark brown", "pale brown", "blonde", "black", "ginger"];
    private $hairTypes = ["curly", "stright", "wavy", "frizzy"];
    private $noseShapes = ["a big", "a small", "a roman", "a proud", "a crooked"];
    private $mouthShapes = ["an almond shaped", "a full", "a thin lipped", "a chapped"];
    private $eyesColours = ["blue", "brown", "dark brown", "green", "yellow", "pale blue", "hazel"];
    private $eyesTypes = ["wide staring", "narrow", "almond shaped"];
    private $eyebrowsTypes = ["arched", "flat", "hairy", "thin"];

    public function getRandomTrait($traitName)
    {
        if ($this->$traitName) {
            $max = count($this->$traitName) - 1;
            return $this->$traitName[rand(0, $max)];
        }

        return "error!";
    }
}
