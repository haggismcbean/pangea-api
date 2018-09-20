<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CharacterBackgroundTraits extends Model
{
    private static $defaultLayout = "{{pronoun}} was {{key}} in {{value}}";

    private static $bornArray = ["The Glorious Republic of Bloop", "The Wondrous Free Community of Blang", "The Revered Town of Hoop-Hoop", "The Crommulist Dictatorship of Schwang", "The Divine Crommulist Freetwon of Dingdong", "The Crommulist Republic of Ding", "The Republic of Pwapwa", "The State of Crommulist Shwaga", "The Crommulist State of Neenor"];
    private static $born;

    private static $fatherWasArray = ["computer scientist", "dancer", "street hustler", "theif", "rapper", "gardener", "tobacco farmer", "cancer patient", "doctor", "politician", "benevolent dictator", "dish washer", "taxi driver", "accountant", "animator", "primary care giver", "juggler", "clown", "project manager", "used car salesman", "mercenary soldier", "General of the Crommulist Republic", "chef", "street hygeine coordinator", "school dinner taste tester"];
    private static $fatherWas;
    private static $fatherWasDefaultLayout = "Father was a {{value}}";

    private static $motherWasArray = ["computer scientist", "dancer", "street hustler", "theif", "rapper", "gardener", "tobacco farmer", "cancer patient", "doctor", "politician", "benevolent dictator", "dish washer", "taxi driver", "accountant", "animator", "primary care giver", "juggler", "clown", "project manager", "used car salesman", "mercenary soldier", "General of the Crommulist Republic", "chef", "street hygeine coordinator", "school dinner taste tester"];
    private static $motherWas;
    private static $motherWasDefaultLayout = "Mother was a {{value}}";

    private static $notableParentWasArray = ["fought in the Great Worker's Struggle as a foot solider", "fought in the Great Worker's Struggle as a flamethrower operator", "fought in the Great Worker's Struggle as a drone operator", "fought in the Great Worker's Struggle as a chef", "fought in the Great Worker's Struggle as a field medic", "was briefly famous for {{posessivePronoun}} role in the Crommulist perges of 2232", "made the headlines in 2212 for falling into a canal", "discovered the cure to Fascism", "became the leader of a cult", "believed in aliens"];
    private static $notableParentWas;
    private static $notableParentWasDefaultLayout = "{{notableParent}} {{value}}";

    private static $graduatedArray = ["top of {{posessivePronoun}} class", "without distinction", "as far as we can tell", "bottom of {{posessivePronoun}} class"];
    private static $graduated;
    private static $graduatedDefaultLayout = "{{pronoun}} {{key}} {{value}}";

    private static $teachersReportsSayArray = ["{{pronoun}} could rarely be found without {{posessivePronoun}} finger up {{posessivePronoun}} nose", "{{pronoun}} was a hard working and conscienscious individual", "{{pronoun}} could do with spending less time chasing members of the opposite sex", "{{pronoun}} should really try harder", "{{pronoun}} unfortunately will never amount to anything"];
    private static $teachersReportsSay;
    private static $teachersReportsSayDefaultLayout = "Teacher's reports from {{posessivePronoun}} early childhood say {{value}}";

    private static $furtherEductationArray = ["went to university at the Logicial and Refined University in Riga", "studied to repair vehicles at the People's Polytechnic University in Slough"];
    private static $furtherEductation;
    private static $furtherEductationDefaultLayout = "After graduating secondary school {{pronoun}} {{value}}";

    private static $citationArray = ["running without a permit", "drinking without a straw", "singing in a restricted noise zone", "believing in the wrong Gods", "asking an impertinent question to a train operator", "stealing a traffic cone", "walking around with {{posessivePronoun}} shoe laces undone", "sneezing in an aggressive manner", "dropping litter in a dog waste bin", "walking on the wrong side of the street", "answering back"];
    private static $citation;
    private static $citationDefaultLayout = "{{pronoun}} received a citation for {{value}}";

    private static $commendationArray = ["photocopying at twice the usual speed during a work placement at the Department of Photocopiers and Paper Pushers", "waving with great enthusiasm as the Regional"];
    private static $commendation;
    private static $commendationDefaultLayout = "{{pronoun}} received a commendation for {{value}}";

    private static $wasSoBoredTheyArray = ["started collecting stamps", "started carving potatoes", "took {{posessivePronoun}} electronic handsignalers apart", "took up draughts", "took up go", "learned to sing the national anthem backwards", "started sowing {{posessivePronoun}} own clothes", "wrote a 500 page book about a rock named Charles", "forgot {{posessivePronoun}} own name", "forgot to eat", "forgot where {{pronoun}} lived"];
    private static $wasSoBoredThey;
    private static $wasSoBoredTheyDefaultLayout = "{{pronoun}} was once so bored {{pronoun}} {{value}}";

    public static function init()
    {
        $traits = [
            "born", "fatherWas", "motherWas", "notableParentWas", "graduated", "teachersReportsSay", "furtherEductation", "citation",
            "commendation", "wasSoBoredThey"
        ];

        foreach( $traits as $trait) {
            CharacterBackgroundTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';
            $defaultLayout = $trait . 'DefaultLayout';

            if (property_exists(new CharacterBackgroundTraits, $defaultLayout)) {
                CharacterBackgroundTraits::${$trait}->defaultLayout = CharacterBackgroundTraits::${$defaultLayout};
            } else if (property_exists(new CharacterBackgroundTraits, 'defaultLayout')) {
                CharacterBackgroundTraits::${$trait}->defaultLayout = CharacterBackgroundTraits::$defaultLayout;
            }

            CharacterBackgroundTraits::${$trait}->addTraitProperties(
                CharacterBackgroundTraits::${$traitArray},
                function($character) {
                    return 1;
                }
            );
        }
    }

    public static function getRandomTrait($traitName, $character)
    {
        $trait = CharacterBackgroundTraits::$$traitName;

        if ($trait !== null) {
            return $trait->getRandomTrait($character);
        }
    }
}
