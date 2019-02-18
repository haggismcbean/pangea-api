<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class RecipeIngredient extends Model
{
    public function recipe()
    {
        return $this->belongsTo('App\MadeItemRecipe', 'item_id');
    }
}
