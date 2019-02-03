<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TextureFactory extends Model
{

    public static function getRandomLustre()
    {
        $lustre = ["shaggy", "smooth", "soft", "coarse", "rough", "matted"];
        $length = count($lustre) - 1;
        $randomIndex = rand(0, $length);
        return $lustre[$randomIndex];
    }
}
