<?php

namespace App\WorldGenerator;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class ExplorationMessageGenerator extends Model
{
    public static function getFailureMessage()
    {
        $failureMessages = [
            "You wander through the wilderness looking for something interesting, but you don't come across anything new.",
        ];

        // TODO - add weather/biome specific messages

        return ExplorationMessageGenerator::getRandomMessage($failureMessages);
    }

    public static function getSuccessMessage() {
        $successMessages = [
            "You wander through the wilderness looking for something interesting. For a while you find nothing, then when you're about to give up hope, something catches your eye.",
        ];

        return ExplorationMessageGenerator::getRandomMessage($successMessages);
    }

    private static function getRandomMessage($messages) {
        $messageLength = count($messages);

        $index = rand(0, $messageLength - 1);

        return $messages[$index];
    }
}
