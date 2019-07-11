<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class PlantName extends Model
{
    public function plant()
    {
        return $this->belongsTo('App\Plant');
    }
}