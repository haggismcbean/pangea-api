<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class Zone extends Model
{
    /**
     * A location can have many characters
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function location()
    {
      return $this->belongsTo(Location::class);
    }

    public function characters()
    {
      return $this->hasMany(Character::class);
    }

    public function items() {
        return $this->belongsToMany('App\Item', 'item_owner', 'owner_id', 'item_id')->where('owner_type', 'zone');
    }

    public function itemOwners() {
        return ItemOwner::where('owner_type', 'zone')
            ->where('owner_id', $this->id);
    }

    public function activities() {
      return $this->hasMany(Activity::class);
    }

    public function mine() {
      return $this->hasOne(Mine::class);
    }
}
