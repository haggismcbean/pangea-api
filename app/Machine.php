<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class Machine extends Model
{
    public function zone() {
        return $this->belongsTo('App\Zone');
    }

    public function activities() {
    	return $this->hasMany('App\Activity');
    }
}
