<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class ZoneFinder extends Model
{
    public function zone()
    {
        return $this->belongsTo('App\Zone');
    }
}