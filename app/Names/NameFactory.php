<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NameFactory extends Model
{

    public static function getRandomSurname()
    {
        $surnames = json_decode(file_get_contents("DataStores/Surnames.json"), true);
        $length = count($surnames) - 1;
        $randomIndex = rand(0, $length);
        return $surnames[$randomIndex];
    }

    public static function getRandomForename($gender)
    {
        if ($gender === "male") {
            $forenames = json_decode(file_get_contents("/var/www/api.pangeana/app/Names/DataStores/MaleForenames.json"), true);
        } else {
            $forenames = json_decode(file_get_contents("/var/www/api.pangeana/app/Names/DataStores/FemaleForenames.json"), true);
        }

        $length = count($forenames) - 1;
        $randomIndex = rand(0, $length);
        return $forenames[$randomIndex];
    }
}
