<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PersonalityFactory extends Model
{

    public static function getRandomManner()
    {
        $manner = ["gracefully", "suspiciously", "with great dignity", "dangerously", "in a friendly manner", "in a playful manner", "in a flirtatious manner", "haughtily", "nervously"];
        $length = count($manner) - 1;
        $randomIndex = rand(0, $length);
        return $manner[$randomIndex];
    }
}
