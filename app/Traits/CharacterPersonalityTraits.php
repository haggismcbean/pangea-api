<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CharacterPersonalityTraits extends Model
{
    // These descriptors must fit in the sentence 'He $keys $value'
    // Eg: 'He enjoys `trout fishing`'
    private static $enjoysArray = [];
    private static $enjoys;

    private static $believesArray = [];
    private static $believes;

    private static $aLargeGroupArray = ["plays the fool", "dominates", "interrupts all the time", "sinks into the background", "withdraws, then interjects loudly with irrelevent details", "waits until its their turn to talk", "agrees with everyone", "agrees with the loudest person", "disagrees with everyone", "disagrees with the loudest person", "sighs loudly", "tries to avoid being in", "mediates well", "mediates poorly", "is a good person to have"];
    private static $aLargeGroup;

    private static $aSeriousConversationArray = ["tends to deflect in", "tends to accuse in", "tends to raise their voice in", "tends to ask meaningless questions in", "tends to make jokes in", "would rather avoid", "seeks out people who can engage in", "believes in the value of"];
    private static $aSeriousConversation;

    public static function init()
    {
        CharacterPersonalityTraits::$enjoysArray = json_decode(file_get_contents("/www/pangea-api/app/Traits/DataStores/Hobbies.json"), true);

        CharacterPersonalityTraits::$believesArray = json_decode(file_get_contents("/www/pangea-api/app/Traits/DataStores/Beliefs.json"), true);

        $traits = [
            'enjoys', 'believes', 'aLargeGroup', 'aSeriousConversation'
        ];

        foreach( $traits as $trait) {
            CharacterPersonalityTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';

            CharacterPersonalityTraits::${$trait}->addTraitProperties(
                CharacterPersonalityTraits::${$traitArray},
                function($character) {
                    return 1;
                }
            );
        }
    }

    public static function getRandomTrait($traitName, $character)
    {
        $trait = CharacterPersonalityTraits::$$traitName;

        if ($trait !== null) {
            return $trait->getRandomTrait($character);
        }
    }
}