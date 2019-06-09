<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;

class Item extends Model
{

    public function characters()
    {
        return $this->belongsToMany('App\Character', 'item_owner', 'item_id', 'owner_id')->where('owner_type', 'character');
    }

    public function zones()
    {
        return $this->belongsToMany('App\Zone', 'item_owner', 'item_id', 'owner_id')->where('owner_type', 'zone');
    }

    public function owners()
    {
        return ItemOwner::where('item_id', $this->id);
    }

    public function traits()
    {
        return $this->belongsToMany('App\ItemTrait', 'item_item_traits', 'item_id', 'trait_id');
    }

    public function itemDetails() {
        if ($this->item_type === 'plant') {
            return $this->belongsTo('App\Plant', 'type_id')->first();
        }

        if ($this->item_type === 'metal') {
            return $this->belongsTo('App\Metal', 'type_id')->first();
        }

        if ($this->item_type === 'mineral') {
            return $this->belongsTo('App\Mineral', 'type_id')->first();
        }

        if ($this->item_type === 'stone') {
            return $this->belongsTo('App\Stone', 'type_id')->first();
        }

        if ($this->item_type === 'animal') {
            return $this->belongsTo('App\Animal', 'type_id')->first();
        }

        if ($this->item_type === 'animal_product') {
            return $this->belongsTo('App\AnimalProduct', 'type_id')->first();
        }

        if ($this->item_type === 'made_item') {
            return $this->belongsTo('App\MadeItem', 'type_id')->first();
        }

        // TODO - seed the made table (partially by hand - things like bread and such)
        // TODO - create a way for cultures to invent dishes
        if ($this->item_type === 'made_food') {
            return $this->belongsTo('App\MadeFood', 'type_id')->first();
        }

        // TODO - 'plant_product' table with food items etc.
    }

    // TODO - remove this?!
    public function itemUses() {
        return $this->hasMany(ItemUse::class, 'item_id');
    }
}
