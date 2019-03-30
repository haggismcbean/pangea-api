<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class ActivityItem extends Model
{
    public function activity() {
        return $this->hasOne(Activity::class, 'activity_id');
    }

    public function zone() {
        return $this->hasOne(Zone::class, 'zone_id');
    }

    public function recipe() {
    	return $this->hasOne(MadeItemRecipe::class, 'recipe_id');
    }
}
