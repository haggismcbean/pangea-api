<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class Activity extends Model
{
	// Character who created it
    public function character() {
        return $this->hasOne(Character::class, 'character_id');
    }

    public function zone() {
        return $this->hasOne(Zone::class, 'zone_id');
    }

    public function recipe() {
    	return $this->hasOne(MadeItemRecipe::class, 'made_item_id', 'recipe_id');
    }

    public function ingredients() {
    	return $this->hasMany(ActivityItem::class);
    }

    // Characters currently working on it
    public function characters() {
    	return $this->hasMany(Character::class);
    }

    public function isReadyForWork() {
    	$ingredients = $this->ingredients()->get();
    	$isReadyForWork = true;

    	foreach ($ingredients as $key => $ingredient) {
    		if ($ingredient->quantity_added != $ingredient->quantity_required) {
    			$isReadyForWork = false;
    		}
    	}

    	return $isReadyForWork;
    }
}
