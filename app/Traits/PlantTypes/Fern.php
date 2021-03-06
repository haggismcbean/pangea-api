<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fern
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
        $this->name = "fern";
        $this->maxHeight = rand(0, 5);
        $this->growthRate = rand(5, 15);
        $this->isSeasonal = true;
        $this->hasFruit = false;
        $this->isPoisonous = false;
        $this->hasFlower = false;
        $this->hasWood = false;

        $this->leafAppearance = "fern";
        $this->rainfallMin = rand(3, 7);
        $this->rainfallMax = $this->rainfallMin + rand(0, 2);
        $this->temperatureMin = rand(1, 4);
        $this->temperatureMax = $this->temperatureMin + rand(0, 2);
        
        // second wave properties
        $this->poisonStrength = rand(0, 10);
        $this->foodStrength = rand(0, 10);
        $this->isEatenRaw = rand(0,30) === 1 ? true : false;
        $this->isEatenCooked = rand(0,30) === 1 ? true : false;
    }
}
