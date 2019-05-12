<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class MineItem extends Model
{

    public function mine()
    {
        return $this->belongsTo('App\Mine');
    }
}