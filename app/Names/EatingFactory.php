<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EatingFactory extends Model
{

    public static function getInedibleMessage($itemName)
    {
        $message = "You hold the " . $itmeName . " up to your mouth and will yourself to chew it down, but you cannot bring yourself to do it";

        return $character->messages()->create([
            'message' => $message,
            'source_type' => 'system',
            'source_name' => 'eating',
            'source_id' => 0
        ]);
    }

    public static function getPoisonousMessage($itemName)
    {
        $message = "You tentatively take a nibble from a corner of the " . $itmeName . ". Almost immediately you start throwing up. After a few minutes you begin to feel better again.";

        return $character->messages()->create([
            'message' => $message,
            'source_type' => 'system',
            'source_name' => 'eating',
            'source_id' => 0
        ]);
    }

    public static function getEdibleMessage($itemName)
    {
        $message = "You eat " . $itemName . ".";

        return $character->messages()->create([
            'message' => $message,
            'source_type' => 'system',
            'source_name' => 'eating',
            'source_id' => 0
        ]);
    }
}
