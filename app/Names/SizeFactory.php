<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SizeFactory extends Model
{

    public static function getRandomSize()
    {
        $size = ["miniscule", "tiny", "weeny", "little", "small", "normal sized", "big", "massive", "huge", "enormous"];
        $length = count($size) - 1;
        $randomIndex = rand(0, $length);
        return $size[$randomIndex];
    }

    public static function getRandomShape()
    {
        $size = ["spherical", "square", "conical", "triangular", "tear shaped", "diamond shaped", "wrinkled", "star shaped", "cross shaped", "key shaped"];
        $length = count($size) - 1;
        $randomIndex = rand(0, $length);
        return $size[$randomIndex];
    }

    public static function getRandomFlowerShape()
    {
        $size = ["spherical", "square", "conical", "triangular", "tear shaped", "diamond shaped", "wrinkled", "star shaped", "cross shaped", "key shaped", "trumpet like"];
        $length = count($size) - 1;
        $randomIndex = rand(0, $length);
        return $size[$randomIndex];
    }

    public static function getRandomLeafShape()
    {
        $size = ["broad spherical", "broad square", "broad conical", "broad triangular", "broad tear shaped", "broad diamond shaped", "large wrinkled", "large star shaped", "large cross shaped", "large key shaped", "narrow spherical", "narrow square", "narrow conical", "narrow triangular", "small tear shaped", "small diamond shaped", "small wrinkled", "small star shaped", "small cross shaped", "small key shaped"];
        $length = count($size) - 1;
        $randomIndex = rand(0, $length);
        return $size[$randomIndex];
    }

    public static function getRandomHairLength()
    {
        $size = ["long", "short", "cropped", "matted"];
        $length = count($size) - 1;
        $randomIndex = rand(0, $length);
        return $size[$randomIndex];
    }

    public static function getRandomRodLength()
    {
        $size = ["long", "short", "dangly", "bow"];
        $length = count($size) - 1;
        $randomIndex = rand(0, $length);
        return $size[$randomIndex];
    }
}
