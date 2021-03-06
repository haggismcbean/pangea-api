<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Climber
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
        $this->name = "climber";
        $this->maxHeight = rand(0, 1);
        $this->growthRate = rand(10, 25);
        $this->isSeasonal = true;
        $this->hasFruit = false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = false;
        $this->hasWood = false;

        $this->leafAppearance = "broad";
        $this->rainfallMin = rand(3, 5);
        $this->rainfallMax = $this->rainfallMin + 2;
        $this->temperatureMin = rand(3, 7);
        $this->temperatureMax = $this->temperatureMin + rand(0, 2);
        
        // second wave properties
        $this->poisonStrength = rand(0, 10);
        $this->foodStrength = rand(0, 10);
        $this->isEatenRaw = rand(0,30) === 1 ? true : false;
        $this->isEatenCooked = rand(0,30) === 1 ? true : false;
    }
}
