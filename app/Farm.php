<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class Farm extends Model
{

    public function zone()
    {
        return $this->belongsTo('App\Zone');
    }

    public function plant()
    {
        return $this->belongsTo('App\Plant');
    }
}