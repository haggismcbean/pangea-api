<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ColorFactory extends Model
{

    public static function getRandomColor()
    {
        $color = ["red", "orange", "yellow", "green", "blue", "purple", "brown", "black", "white", "pink"];
        $length = count($color) - 1;
        $randomIndex = rand(0, $length);
        return $color[$randomIndex];
    }

    public static function getRandomAutumnColor()
    {
        $color = ["red", "orange", "yellow", "green"];
        $length = count($color) - 1;
        $randomIndex = rand(0, $length);
        return $color[$randomIndex];
    }

    public static function getRandomLeafColor()
    {
        $color = ["yellow", "green", "purple"];
        $length = count($color) - 1;
        $randomIndex = rand(0, $length);
        return $color[$randomIndex];
    }

    public static function getRandomFurColor()
    {
        $color = ["brown", "yellow", "orange", "black", "white"];
        $length = count($color) - 1;
        $randomIndex = rand(0, $length);
        return $color[$randomIndex];
    }

    public static function getRandomShade()
    {
        $shade = ["pale", "bright", "pastle", "muted", "vibrant", "kind of", "dull"];
        $length = count($shade) - 1;
        $randomIndex = rand(0, $length);
        return $shade[$randomIndex];
    }

    public static function getRandomPattern()
    {
        $pattern = ["spots", "checkers", "lines", "slits", "strips", "dimples", "blops", "dots"];
        $length = count($pattern) - 1;
        $randomIndex = rand(0, $length);
        return $pattern[$randomIndex];
    }
}
