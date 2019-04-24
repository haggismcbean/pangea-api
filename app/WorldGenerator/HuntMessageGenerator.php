<?php

namespace App\WorldGenerator;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class HuntMessageGenerator extends Model
{
    public static function getFailureMessage()
    {
        $failureMessages = [
            "Time passes",
            "You sat quietly but nothing happened",
            "You see nothing but a few birds fluttering about",
            "A deer creeps into view. It bends its head nervously to eat on some grass. But it walks off before it gets into range",
            "A deer walks into view from behind a nearby bush. You move as slowly as you can to get into position, but something must have spooked it; it runs away",
            "The birds are singing",
            "An insect walks across the back of your hand; you brush it away",
            "You sit in the countryside and wait",
        ];

        // TODO - add weather/biome specific messages

        return HuntMessageGenerator::getRandomMessage($failureMessages);
    }

    public static function getSuccessMessage() {
        $successMessages = [
            "A deer crept into view, nervously browsing on the grasses nearby. You stayed still until it was very close, then you launched a projectile. You hit your target. The deer ran away, but it left a trail of blood. Following the trail, you find the deer lying gasping for air a short distance away. You finish it off."
        ];

        return HuntMessageGenerator::getRandomMessage($failureMessages);
    }

    // TODO - implement interruption (can only hunt when alone/with other hunters)
    public static function getInterruptionMessage() {
        $interruptionMessage = [
            "As you are sat waiting for an animal to fall into your trap, a human brazenly walks into the area, making enough noise to scare away any deer that were nearby"
        ];

        return HuntMessageGenerator::getRandomMessage($failureMessages);
    }

    private static function getRandomMessage($messages) {
        $messageLength = count($messages);

        $index = rand(0, $messageLength - 1);

        return $messages[$index];
    }
}
