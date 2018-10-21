<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ColorFactory extends Model
{

    public static function getRandomColor()
    {
        $color = ["red", "orange", "yellow", "green", "blue", "purple", "brown", "black", "white", "pink"];
        $length = count($size) - 1;
        $randomIndex = rand(0, $length);
        return $size[$randomIndex];
    }

    public static function getRandomShade()
    {
        $color = ["pale", "bright", "pastle", "muted", "vibrant"];
        $length = count($size) - 1;
        $randomIndex = rand(0, $length);
        return $size[$randomIndex];
    }

    public static function getRandomPattern()
    {
        $color = ["spots", "checkers", "lines", "slits", "strips", "dimples", "blops", "dots"];
        $length = count($size) - 1;
        $randomIndex = rand(0, $length);
        return $size[$randomIndex];
    }
}
