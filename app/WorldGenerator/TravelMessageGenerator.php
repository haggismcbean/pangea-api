<?php

namespace App\WorldGenerator;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class TravelMessageGenerator extends Model
{
    public static function getFailureMessage()
    {
        $failureMessages = [
            "You get lost and spend a few minutes before you realise which direction you should travel in",
        ];

        return TravelMessageGenerator::getRandomMessage($failureMessages);
    }

    public static function getSuccessMessage($zone) {
        return $zone->description;
    }

    private static function getRandomMessage($messages) {
        $messageLength = count($messages);

        $index = rand(0, $messageLength - 1);

        return $messages[$index];
    }
}
