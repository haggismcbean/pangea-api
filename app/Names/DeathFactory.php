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
}
