<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class Plant extends Model
{
    public function biomes()
    {
        return $this->belongsToMany('App\Biome');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function items() {
    	return $this->hasMany(Item::class, 'type_id')->where('item_type', 'plant');
    }

    public function names() {
        return $this->hasMany('App\PlantName');
    }

    public function getName($character) {
        $plantName = $this->names()
            ->where('character_id', $character->id)
            ->first();

        if ($plantName) {
            return $plantName->plant_name;
        }
    }
}