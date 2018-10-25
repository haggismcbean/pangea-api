<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Grass
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
        $this->name = "grass";
        $this->maxHeight = rand(10, 20);
        $this->growthRate = rand(10, 25);
        $this->isSeasonal = false;
        $this->hasFruit = false;
        $this->isPoisonous = rand(0, 20) === 1 ? true : false;
        $this->hasFlower = false;

        $this->rainfallMin = 1;
        $this->rainfallMax = 5;
        $this->temperatureMin = 1;
        $this->temperatureMax = 4;
    }
}
