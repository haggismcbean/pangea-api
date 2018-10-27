<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class LocationPlant extends Model
{
	protected $table = 'location_plant';

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}