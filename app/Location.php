<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class Location extends Model
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($age = null)
    {
        $this->x_coord;
        $this->y_coord;
        $this->z_coord;
    }

    /**
     * A location can have many characters
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function characters()
    {
      return $this->hasMany(Character::class);
    }

    public function biome()
    {
        return $this->belongsTo('App\Biome');
    }

    public function plants()
    {
        return $this->belongsToMany('App\Plant');
    }

    public function locationPlants()
    {
        return $this->hasMany('App\LocationPlant');
    }

    public function locationItems()
    {
        return $this->hasMany('App\LocationItem');
    }

    public function zones() {
        return $this->hasMany('App\Zone');
    }

    public function getLocationPlant($plantId) {
        return $this->locationPlants()
            ->where('plant_id', $plantId)
            ->first();
    }

    public function getPlant($plantId) {
        return $this->plants()
            ->where('plant_id', $plantId)
            ->first();
    }
}
