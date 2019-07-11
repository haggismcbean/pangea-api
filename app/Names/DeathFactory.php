<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeathFactory extends Model
{

    public static function getHungerMessage($character)
    {
        $message = "You vision fades. You sit down where you stood and realise you don't feel hungry any more. You rise up, you see the top of your head, you keep rising. And then there is no more.";

        return $character->messages()->create([
            'message' => $message,
            'source_type' => 'system',
            'source_name' => 'death',
            'source_id' => 0
        ]);
    }

    public static function getExposureMessage($character)
    {
        $message = "You vision fades. You sit down where you stood and realise you don't feel cold any more. A shadow crosses. A veil lifts. All things die.";

        return $character->messages()->create([
            'message' => $message,
            'source_type' => 'system',
            'source_name' => 'death',
            'source_id' => 0
        ]);
    }

    public static function getPoisonMessage($character) {
        $message = "You fall to the ground gagging and throwing up. Then you die.";

        return $character->messages()->create([
            'message' => $message,
            'source_type' => 'system',
            'source_name' => 'death',
            'source_id' => 0
        ]);
    }

    public static function getOfflineMessage($character)
    {
        if ($character->hunger < 1) {
            $message = "You were too hungry to dream, but you find yourself at a table covered with food. You grab the closest dish, it's creamed potatoes. You shove them into your mouth, handful after handful. You don't wake up.";
        }

        if ($character->exposure < 1) {
            $message = "You were too cold to dream, but you find yourself in a bed covered with furs. You swim through the soft warm furs, ermine, bear, wolf pelts stroke against your naked skin. You don't wake up.";
        }

        return $character->messages()->create([
            'message' => $message,
            'source_type' => 'system',
            'source_name' => 'death',
            'source_id' => 0
        ]);
    }
}
