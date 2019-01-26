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

    public function itemDetails() {
        if ($this->item_type === 'plant') {
            return $this->belongsTo('App\Plant', 'type_id')->first();
        }

        // TODO - seed the wood table
        if ($this->item_type === 'wood') {
            return $this->belongsTo('App\Wood', 'type_id')->first();
        }

        // TODO - seed the stone table
        if ($this->item_type === 'stone') {
            return $this->belongsTo('App\Stone', 'type_id')->first();
        }

        // TODO - seed the animal_product table (first create animals though!)
        if ($this->item_type === 'animal_product') {
            return $this->belongsTo('App\AnimalProduct', 'type_id')->first();
        }

        // TODO - seed the metal table (by hand)
        if ($this->item_type === 'metal') {
            return $this->belongsTo('App\Metal', 'type_id')->first();
        }

        // TODO - seed the mineral table (by hand)
        if ($this->item_type === 'mineral') {
            return $this->belongsTo('App\Mineral', 'type_id')->first();
        }

        // TODO - seed the made table (by hand)
        // TODO - seed the made item recipes table (by hand)
        // TODO - seed the made item recipe ingredients table (by hand)
        // It might be useful to just make a little helper webpage for this. And for adding items in general.
        // Seems less painful than entering things directly into a database.
        // Bear in mind you want to be able to seed things though
        if ($this->item_type === 'made_item') {
            return $this->belongsTo('App\Made', 'type_id')->first();
        }

        // TODO - seed the made table (partially by hand - things like bread and such)
        // TODO - create a way for cultures to invent dishes
        if ($this->item_type === 'made_food') {
            return $this->belongsTo('App\MadeFood', 'type_id')->first();
        }

        // WHEN ALL OF THE ABOVE IS DONE, WE CAN WORK OUT THE ITEMS TABLE STUFF
        // I think it might be easier to get all this stuff working if i have a big excel table and then we read the stuff from there
        // One for each seeded thing
        // And different rows in it seed different tables.
    }
}
