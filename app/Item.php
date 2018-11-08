<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class Item extends Model
{

    public function characters()
    {
        return $this->belongsToMany('App\Character', 'item_owner', 'itemId', 'ownerId')->where('ownerType', 'character');
    }

    // public function zones()
    // {
    //     return $this->belongsToMany('App\Zone');
    // }
}
