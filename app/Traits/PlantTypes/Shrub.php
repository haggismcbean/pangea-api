<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Shrub
{
    public $name;
    public $maxHeight;
    public $growthRate;
    public $isSeasonal;
    public $hasFruit;
    public $isPoisonous;
    public $hasFlower;
    public $leafAppearance;
    public $hasWood;
    public $woodAppearance;

    public $rainfallMin;
    public $rainfallMax;
    public $temperatureMin;
    public $temperatureMax;

    public $poisonStrength;
    public $foodStrength;
    public $isEatenRaw;
    public $isEatenCooked;

    public function __construct()
    {
        $this->name = "shrub";
        $this->maxHeight = rand(0, 5);
        $this->growthRate = rand(0, 15);
        $this->isSeasonal = true;
        $this->hasFruit = rand(0, 20) === 1 ? true : false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = true;
        $this->hasWood = false;

        $this->leafAppearance = rand(0, 1) === 1 ? "broad" : "narrow";
        $this->rainfallMin = rand(1, 6);
        $this->rainfallMax = $this->rainfallMin + rand(0, 4);
        $this->temperatureMin = rand(1, 8);
        $this->temperatureMax = $this->temperatureMin + rand(0, 6);
        
        // second wave properties
        $this->poisonStrength = rand(0, 10);
        $this->foodStrength = rand(0, 10);
        $this->isEatenRaw = rand(0,30) === 1 ? true : false;
        $this->isEatenCooked = rand(0,30) === 1 ? true : false;
    }
}
