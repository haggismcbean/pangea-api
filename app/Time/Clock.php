<?php

namespace App\Time;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Clock
{
    public static function getDayOfYear()
    {
        $day1 = date_create(date('2019-01-01'));
        $today = date_create(date('Y-m-d'));

        $difference = $day1->diff($today);

        // Remainder of days / 40
        $modulo = $difference->days % 40;

        return $modulo;
        // returns a number between 0 and 39.
    }

    // public static function getDayOfSeason($biome)
    // {
    //     $surnames = json_decode(file_get_contents("/www/pangea-api/app/Names/DataStores/Surnames.json"), true);
    //     $length = count($surnames) - 1;
    //     $randomIndex = rand(0, $length);
    //     return $surnames[$randomIndex];
    // }

    // public static function getDayOfSeason($biome)
    // {
    //     $surnames = json_decode(file_get_contents("/www/pangea-api/app/Names/DataStores/Surnames.json"), true);
    //     $length = count($surnames) - 1;
    //     $randomIndex = rand(0, $length);
    //     return $surnames[$randomIndex];
    // }
}
