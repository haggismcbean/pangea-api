<?php

namespace App\WorldGenerator;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class FarmMessageGenerator extends Model
{
    public static function getFailureMessage()
    {
        $failureMessages = [
            "You dawdle about wasting time and not accomplishing much at all",
        ];

        // TODO - add weather/biome specific messages

        return HuntMessageGenerator::getRandomMessage($failureMessages);
    }

    public static function getSuccessMessage() {
        $successMessages = [
            "You potter about picking up weeds and generally making yourself useful",
        ];

        return HuntMessageGenerator::getRandomMessage($successMessages);
    }

    private static function getRandomMessage($messages) {
        $messageLength = count($messages);

        $index = rand(0, $messageLength - 1);

        return $messages[$index];
    }
}
