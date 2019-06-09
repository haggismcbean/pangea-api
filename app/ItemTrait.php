<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class ItemTrait extends Model
{

    public function items()
    {
        return $this->belongsToMany('App\Item', 'item_item_traits', 'trait_id', 'item_id');
    }
}
