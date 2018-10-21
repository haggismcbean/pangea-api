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
}
