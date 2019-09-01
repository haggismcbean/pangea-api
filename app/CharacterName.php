<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class CharacterName extends Model
{
    public function character()
    {
        return $this->belongsTo('App\Character');
    }
}