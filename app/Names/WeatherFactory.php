<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WeatherFactory extends Model
{

    public static function getMessage($temperature, $rainfall)
    {
        // temp between 0 and 7
        switch ($temperature) {
            case 0:
            case 1:
            case 2:
                switch ($rainfall) {
                    case 0:
                    case 1: 
                    case 2:
                        return "It is cold";
                    case 3:
                    case 4:
                        return "It is snowing steadily";
                    case 5:
                    case 6:
                        return "There is a blizzard";
                }

            case 3:
                switch ($rainfall) {
                    case 0:
                    case 1: 
                    case 2:
                        return "It is chilly";
                    case 3:
                    case 4:
                        return "It is drizzling";
                    case 5:
                    case 6:
                        return "It is raining heavily";
                }

            case 4:
                switch ($rainfall) {
                    case 0:
                    case 1: 
                    case 2:
                        return "It is a nice day";

                    case 3:
                    case 4:
                        return "It is a warm day, but there is a gentle mist falling";

                    case 5:
                    case 6:
                        return "It is hot and muggy and raining heavily";
                }

            case 5:
            case 6:
            case 7:
                switch ($rainfall) {
                    case 0:
                    case 1: 
                    case 2:
                        return "It is hot";

                    case 3:
                    case 4:
                        return "It is raining a little despite the heat";

                    case 5:
                    case 6:
                        return "It is raining heavily despite the heat";
                }
        }
    }
}
