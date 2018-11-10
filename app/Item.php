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
        return $this->belongsToMany('App\Character', 'item_owner', 'item_id', 'owner_id')->where('owner_type', 'character');
    }

    public function zones()
    {
        return $this->belongsToMany('App\Zone', 'item_owner', 'item_id', 'owner_id')->where('owner_type', 'zone');
    }

    public function itemDetails() {
    	if ($this->item_type === 'plant') {
    		return $this->belongsTo('App\Plant', 'type_id')->first();
    	}
    }
}
