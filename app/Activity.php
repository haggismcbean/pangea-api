<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class Activity extends Model
{
    public function character() {
        return $this->hasOne(Character::class, 'character_id');
    }

    public function zone() {
        return $this->hasOne(Zone::class, 'zone_id');
    }

    public function recipe() {
    	return $this->hasOne(MadeItemRecipe::class, 'recipe_id');
    }
}
