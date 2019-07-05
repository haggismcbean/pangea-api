<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\CharacterFactory;
use App\Message;
use App\User;
use Auth;


class Character extends Model
{
    use SoftDeletes;

    private $age;

    protected $notableParent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($age = null)
    {}

    public function generate()
    {
        $character = new CharacterFactory();

        $this->location_id = 0;
        $this->birthday = $character->birthday;
        $this->gender = $character->gender;
        $this->age = $character->age;
        $this->height = $character->height;
        $this->weight = $character->weight;
        $this->strength = $character->strength;
        $this->pronoun = $character->pronoun;
        $this->posessivePronoun = $character->posessivePronoun;
        $this->forename = $character->forename;
        $this->surname = $character->surname;
        $this->name = $character->name;
        $this->appearance = $character->appearance;
        $this->personality = $character->personality;
        $this->backstory = $character->backstory;
        $this->health = 100;
        $this->hunger = 100;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function items() {
        return $this->belongsToMany('App\Item', 'item_owner', 'owner_id', 'item_id')
            ->where('owner_type', 'character');
    }

    public function itemOwners() {
        return ItemOwner::where('owner_type', 'character')
            ->where('owner_id', $this->id);
    }

    public function zone() {
        return $this->belongsTo('App\Zone');
    }

    // activities created by this character
    public function activities() {
        return $this->hasMany('App\Activity');
    }

    // activity currently working on
    public function activity() {
        return $this->belongsTo('App\Activity');
    }

    /**
     * A character can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
      return $this->hasMany(Message::class);
    }

    public function hasInventorySpace() {
        $inventorySpace = 100;
        $totalItems = 0;
        $items = $this->itemOwners()->get();

        foreach ($items as $item) {
            $totalItems = $totalItems + $item->count;
        }

        return $totalItems < $inventorySpace;
    }
}
