<?php

namespace App\Traits\AnimalTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AnimalType
{
    public function getSizeString($size) {
        if ($size < 20) {
            return "tiny";
        }

        if ($size < 40) {
            return "small";
        }

        if ($size < 60) {
            return "medium sized";
        }

        if ($size < 80) {
            return "big";
        }

        if ($size < 100) {
            return "enormous";
        }
    }
}
