<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class Biome extends Model
{

    public function plants()
    {
        return $this->belongsToMany(Plant::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}