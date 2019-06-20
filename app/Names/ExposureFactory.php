<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ExposureFactory extends Model
{

    public static function getMessage($exposure)
    {
        switch ($exposure) {
            case $exposure < 0: 
                return "You are dead";

            case $exposure < 30:
                return "You can't stop shivering. The only thing you can think about is finding somewhere warm. You do not have long left";

            case $exposure < 60:
                return "You are shivering violently";

            case $exposure < 101:
                return "You feel a little chilly";                
        }
    }
}
