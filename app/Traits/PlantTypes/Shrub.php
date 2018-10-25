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

    public $rainfallMin;
    public $rainfallMax;
    public $temperatureMin;
    public $temperatureMax;

    public function __construct()
    {
        $this->name = "shrub";
        $this->maxHeight = rand(0, 5);
        $this->growthRate = rand(0, 15);
        $this->isSeasonal = true;
        $this->hasFruit = rand(0, 20) === 1 ? true : false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = true;

        $this->leafAppearance = rand(0, 1) === 1 ? "broad" : "narrow";
        $this->rainfallMin = 1;
        $this->rainfallMax = 7;
        $this->temperatureMin = 1;
        $this->temperatureMax = 6;
    }
}
