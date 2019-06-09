<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class RecipeIngredient extends Model
{
	protected $fillable = [
        'quantity_min', 'quantity_max', 'recipe_id', 'item_id', 'item_type', 'skill_name', 'is_consumed', 'item_trait_id'
    ];

    public function recipe()
    {
        return $this->belongsTo('App\MadeItemRecipe', 'recipe_id');
    }

    public function item() {
    	return $this->belongsTo('App\Item', 'item_id');
    }

    public function trait() {
        return $this->hasOne('App\ItemTrait', 'id', 'item_trait_id');
    }
}
