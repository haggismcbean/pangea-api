<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class Group extends Model
{

    public function characters()
    {
        return $this->hasMany('App\Character');
    }
}