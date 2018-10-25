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
        return $this->belongsToMany(Biome::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }
}