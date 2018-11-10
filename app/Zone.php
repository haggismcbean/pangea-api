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
        return $this->belongsToMany('App\Item', 'item_owner', 'ownerId', 'itemId')->where('ownerType', 'zone');
    }

    public function itemOwners() {
        return ItemOwner::where('owner_type', 'zone')
            ->where('owner_id', $this->id);
    }
}
