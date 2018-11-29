<?php

namespace App\WorldGenerator;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class BiomeDescriptionGenerator extends Model
{

    public static function getDescription($biome) {
        return "You find yourself in a right nice bit o' wilderness";        
    }
}
