<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Broadleaf
{
    public $name;
    public $maxHeight;
    public $growthRate;
    public $isSeasonal;
    public $hasFruit;
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
        $this->name = "broadleaf";
        $this->maxHeight = rand(70, 100);
        $this->growthRate = rand(0, 10);
        $this->isSeasonal = true;
        $this->hasFruit = rand(0, 50) === 1 ? true : false;
        $this->hasFlower = true;
        $this->hasWood = true;

        $this->leafAppearance = "broad";
        $this->rainfallMin = rand(3, 8);
        $this->rainfallMax = $this->rainfallMin + rand(0, 3);
        $this->temperatureMin = rand(3, 5);
        $this->temperatureMax = $this->rainfallMin + rand(0, 3);
        
        // second wave properties
        $this->poisonStrength = rand(0, 10);
        $this->foodStrength = rand(0, 10);
        $this->isEatenRaw = rand(0,30) === 1 ? true : false;
        $this->isEatenCooked = rand(0,30) === 1 ? true : false;
    }
}
