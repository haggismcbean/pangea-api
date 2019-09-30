<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

use App\World\Clock;

class Plant extends Model
{
    public function biomes()
    {
        return $this->belongsToMany('App\Biome');
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function items() {
    	return $this->hasMany(Item::class, 'type_id')->where('item_type', 'plant');
    }

    public function names() {
        return $this->hasMany('App\PlantName');
    }

    public function getName($character) {
        $plantName = $this->names()
            ->where('character_id', $character->id)
            ->first();

        if ($plantName) {
            return $plantName->plant_name;
        }
    }

    public function setOutOfSeasonProperties() {
        $day = Clock::getDayOfYear();

        if ($this->isSeasonal) {
            // so basically one quarter of the year we want to hide the leaves
            if (Clock::isWithinDays($day, $this->troughLeavesDay, 10)) {
                // return winter leaves
                $this->leafAppearance = null;
            } else {
                if (Clock::isWithinDays($day, $this->troughLeavesDay - 10, 10)) {
                    // return autumn leaves
                    $this->leafAppearance = "It has dead wrinkled leaves";
                };
            }
        }

        // fruit
        if (!Clock::isWithinDays($day, $this->peakFruitDay, 8)) {
            
            if (Clock::isWithinDays($day, $this->peakFruitDay - 4, 4)) {
                $this->fruitAppearance = $this->fruitAppearance . "They look under ripe";
            } else if (Clock::isWithinDays($day, $this->peakFruitDay + 4, 4)) {
                $this->fruitAppearance = $this->fruitAppearance . "They look over ripe";
            } else {
                $this->fruitAppearance = null;
            }
        }


        // flowers
        if (!Clock::isWithinDays($day, $this->peakFlowerDay, 8)) {
            
            if (Clock::isWithinDays($day, $this->peakFlowerDay - 4, 4)) {
                $this->flowerAppearance = $this->flowerAppearance . "They look under developed";
            } else if (Clock::isWithinDays($day, $this->peakFlowerDay + 4, 4)) {
                $this->flowerAppearance = $this->flowerAppearance . "They are withering slightly";
            } else {
                $this->flowerAppearance = null;
            }
        }

        // seeds
        if (!Clock::isWithinDays($day, $this->peakSeedDay, 8)) {
            
            if (Clock::isWithinDays($day, $this->peakSeedDay - 4, 4)) {
                $this->seedAppearance = $this->seedAppearance . "They look under developed";
            } else if (Clock::isWithinDays($day, $this->peakSeedDay + 4, 4)) {
                $this->seedAppearance = $this->seedAppearance . "They are withering slightly";
            } else {
                $this->seedAppearance = null;
            }
        }

        return $this;
    }

    public function getTodaysAvailableYield($plantPart) {

        if ($plantPart === 'fruit') {
            return $this->getYieldFromPeakDay($this->peakFruitDay);
        }

        if ($plantPart === 'flower') {
            return $this->getYieldFromPeakDay($this->peakFlowerDay);
        }

        if ($plantPart === 'seed') {
            return $this->getYieldFromPeakDay($this->peakSeedDay);
        }

        if ($plantPart === 'leaf') {
            return $this->getYieldFromPeakDay($this->peakLeafDay);
        }

        if ($plantPart === 'stalk') {
            return $this->getYieldFromPeakDay($this->peakStalkDay);
        }

        if ($plantPart === 'root') {
            return $this->getYieldFromPeakDay($this->peakRootDay);
        }

        return 0;
    }

    private function getYieldFromPeakDay($peakDay) {
        $day = Clock::getDayOfYear();

        if (Clock::isWithinDays($day, $peakDay, 1)) {
            return $this->yearly_yield / 2;
        }

        if (Clock::isWithinDays($day, $peakDay, 2)) {
            return $this->yearly_yield / 4;
        }

        return 0;
    }
}