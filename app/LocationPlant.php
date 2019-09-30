<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class LocationPlant extends Model
{
    protected $table = 'location_plant';

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function isAvailable($amount, $plantPart) {
    	$plant = $this->plant()->first();
    	$availableYieldToday = $plant->getTodaysAvailableYield($plantPart);
    	$requestedYield = $amount * $plant->yield_per_item;

    	if ($plantPart === 'fruit'
    			&& $this->fruit_gathered_today + $requestedYield > $availableYieldToday) {
    		return false;
    	}
    	if ($plantPart === 'flower'
    			&& $this->flower_gathered_today + $requestedYield > $availableYieldToday) {
    		return false;
    	}
    	if ($plantPart === 'seed'
    			&& $this->seed_gathered_today + $requestedYield > $availableYieldToday) {
    		return false;
    	}
    	if ($plantPart === 'leaf'
    			&& $this->leaf_gathered_today + $requestedYield > $availableYieldToday) {
    		return false;
    	}
    	if ($plantPart === 'stalk'
    			&& $this->stalk_gathered_today + $requestedYield > $availableYieldToday) {
    		return false;
    	}
    	if ($plantPart === 'root'
    			&& $this->root_gathered_today + $requestedYield > $availableYieldToday) {
    		return false;
    	}
    	return true;
    }
}