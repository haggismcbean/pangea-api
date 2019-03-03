<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SoundFactory extends Model
{

    public static function getRandomAnimalSound()
    {
        $size = ["shrieks", "cries", "roars", "whistles", "sings", "howls", "clicks", "cackles", "laughs"];
        $length = count($size) - 1;
        $randomIndex = rand(0, $length);
        return $size[$randomIndex];
    }

    public static function getRandomAnimalSoundAction()
    {
        $size = ["calling", "shrieking", "crying", "whistling", "clicking", "cackling", "howling", "laughing", "singing", "roaring"];
        $length = count($size) - 1;
        $randomIndex = rand(0, $length);
        return $size[$randomIndex];
    }
}
