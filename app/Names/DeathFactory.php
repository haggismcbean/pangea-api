<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ExposureFactory extends Model
{

    public static function getHungerMessage()
    {
        return "You vision fades. You sit down where you stood and realise you don't feel hungry any more. You rise up, you see the top of your head, you keep rising. And then there is no more.";
    }

    public static function getExposureMessage()
    {
        return "You vision fades. You sit down where you stood and realise you don't feel cold any more. A shadow crosses. A veil lifts. All things die.";
    }

    public static function getOfflineMessage($character)
    {
        if ($character->hunger < 1) {
            return "You were too hungry to dream, but you find yourself at a table covered with food. You grab the closest dish, it's creamed potatoes. You shove them into your mouth, handful after handful. You don't wake up.";
        }

        if ($character->exposure < 1) {
            return "You were too cold to dream, but you find yourself in a bed covered with furs. You swim through the soft warm furs, ermine, bear, wolf pelts stroke against your naked skin. You don't wake up.";
        }
    }
}
