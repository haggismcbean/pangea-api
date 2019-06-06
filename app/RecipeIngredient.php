<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class RecipeIngredient extends Model
{
	protected $fillable = [
        'quantity_min', 'quantity_max', 'recipe_id', 'item_id', 'item_type', 'skill_name', 'is_consumed'
    ];

    public function recipe()
    {
        return $this->belongsTo('App\MadeItemRecipe', 'recipe_id');
    }

    public function item() {
    	return $this->belongsTo('App\Item', 'item_id');
    }
}
