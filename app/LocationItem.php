<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class LocationItem extends Model
{
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function item() {
        if ($this->item_type === 'plant') {
            return $this->belongsTo('App\Plant', 'item_id')->first();
        }

        if ($this->item_type === 'metal') {
            return $this->belongsTo('App\Metal', 'item_id')->first();
        }

        if ($this->item_type === 'mineral') {
            return $this->belongsTo('App\Mineral', 'item_id')->first();
        }

        if ($this->item_type === 'stone') {
            return $this->belongsTo('App\Stone', 'item_id')->first();
        }

        if ($this->item_type === 'animal') {
            return $this->belongsTo('App\Animal', 'item_id')->first();
        }

        if ($this->item_type === 'animal_product') {
            return $this->belongsTo('App\AnimalProduct', 'item_id')->first();
        }

        if ($this->item_type === 'made_item') {
            return $this->belongsTo('App\Made', 'item_id')->first();
        }
    }
}
