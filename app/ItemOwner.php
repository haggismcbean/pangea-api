<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class ItemOwner extends Model
{
    protected $table = 'item_owner';

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function owner()
    {
    	if ($this->ownerType === 'character') {
        	return $this->belongsTo(Character::class);
    	}
    }
}