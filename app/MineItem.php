<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class MineItem extends Model
{

    public function mine()
    {
        return $this->belongsTo('App\Mine');
    }

    public function item()
    {
        if ($this->item_type === 'stone') {
            return $this->belongsTo('App\Stone', 'item_id')->first();
        }
    }
}