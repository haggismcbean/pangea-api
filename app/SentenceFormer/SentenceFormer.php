<?php

namespace App\SentenceFormer;

class SentenceFormer
{
    public static function formSentence($trait)
    {
        var_dump($trait);
        if ($trait->defaultLayout != false) {
            //so the idea is now to read through traits in the following manner:

            // any time we find ${pronoun}, we replace with the relevent pronoun

            // any time we find ${key}, we replace with the key

            // and so on...?
        } else {
            //we read the default layout and insert the requisite parts into THAT
        }
    }
}
