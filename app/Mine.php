<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class Mine extends Model
{

    public function zone()
    {
        return $this->belongsTo('App\Zone');
    }

    public function items()
    {
        return $this->hasMany('App\MineItem');
    }
}