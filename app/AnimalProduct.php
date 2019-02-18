<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class AnimalProduct extends Model
{
    public function items() {
        return $this->hasOne(Item::class, 'type_id')->where('item_type', 'animal_product');
    }
}
