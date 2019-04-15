<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class ItemUse extends Model
{

    public function item() {
        return $this->belongsTo('App\MadeItem', 'item_id');
    }
}
