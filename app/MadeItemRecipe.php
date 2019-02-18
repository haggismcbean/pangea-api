<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class MadeItemRecipe extends Model
{
    public function item()
    {
        return $this->belongsTo('App\MadeItem', 'made_item_id');
    }
}
