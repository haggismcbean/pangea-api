<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CharacterBackgroundTraits extends Model
{
    private static $bornArray = ["The Glorious Republic of", "The Wondrous Free Community of", "The Revered Town of", "The Crommulist Dictatorship of", "The Divine Crommulist Freetwon of", "The Crommulist Republic of", "The Republic of", "The State of Crommulist", "The Crommulist State of"];
    private static $born;

    private static $fatherWasArray = ["computer scientist", "dancer", "street hustler", "theif", "rapper", "gardener", "tobacco farmer", "cancer patient", "doctor", "politician", "benevolent dictator", "dish washer", "taxi driver", "accountant", "animator", "primary care giver", "juggler", "clown", "project manager", "used car salesman", "mercenary soldier", "General of the Crommulist Republic", "chef", "street hygeine coordinator", "school dinner taste tester"];
    private static $fatherWas;

    private static $notableParentArray = ["fought in the Great Worker's Struggle as a footsoldier", "fought in the Great Worker's Struggle as a flamethrower operator", "fought in the Great Worker's Struggle as a drone operator", "fought in the Great Worker's Struggle as a chef", "fought in the Great Worker's Struggle as a field medic", "was briefly famous for their role in the Crommulist perges of 2232", "made the headlines in 2212 for falling into a canal", "discovered the cure to Fascism", "became the leader of a cult", "believed in aliens"];
    private static $notableParent;

    private static $graduatedArray = ["top of their class", "without distinction", "as far as we can tell", "bottom of their class"];
    private static $graduated;

    private static $teachersReportsSayArray = ["they could rarely be found without their finger up their nose", "they were a hard working and conscienscious individual", "they could do with spending less time chasing members of the opposite sex", "they should really try harder", "they unfortunately will never amount to anything"];
    private static $teachersReportsSay;

    private static $furtherEductationArray = ["went to university at the Logicial and Refined University in Riga", "studied to repair vehicles at the People's Polytechnic University in Slough"];
    private static $furtherEductation;

    private static $citationArray = ["running without a permit", "drinking without a straw", "singing in a restricted noise zone", "believing in the wrong Gods", "asking an impertinent question to a train operator", "stealing a traffic cone", "walking around with their shoe laces undone", "sneezing in an aggressive manner", "dropping litter in a dog waste bin", "walking on the wrong side of the street", "answering back"];
    private static $citation;

    private static $commendationArray = ["photocopying at twice the usual speed during a work placement at the Department of Photocopiers and Paper Pushers", "waving with great enthusiasm as the Regional"];
    private static $commendation;

    private static $wasSoBoredTheyArray = ["started collecting stamps", "started carving potatoes", "took their electronic handsignalers apart", "took up draughts", "took up go", "learned to sing the national anthem backwards", "started sowing their own clothes", "wrote a 500 page book about a rock named Charles", "forgot their own name", "forgot to eat", "forgot where they lived"];
    private static $wasSoBoredThey;

    public static function init()
    {
        $traits = [
            "born", "fatherWas", "notableParent", "graduated", "teachersReportsSay", "furtherEductation", "citation",
            "commendation", "wasSoBoredThey"
        ];

        foreach( $traits as $trait) {
            CharacterBackgroundTraits::${$trait} = new Traits($trait);
            $traitArray = $trait . 'Array';

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
