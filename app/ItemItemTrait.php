<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class ItemItemTrait extends Model
{

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function trait()
    {
        return $this->belongsTo('App\Trait');
    }
}
