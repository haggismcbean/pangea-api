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

    public $rainfallMin;
    public $rainfallMax;
    public $temperatureMin;
    public $temperatureMax;

    public function __construct()
    {
        $this->name = "climber";
        $this->maxHeight = rand(0, 1);
        $this->growthRate = rand(10, 25);
        $this->isSeasonal = true;
        $this->hasFruit = false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = false;

        $this->leafAppearance = "broad";
        $this->rainfallMin = 3;
        $this->rainfallMax = 7;
        $this->temperatureMin = 3;
        $this->temperatureMax = 6;
    }
}
