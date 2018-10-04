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
}
