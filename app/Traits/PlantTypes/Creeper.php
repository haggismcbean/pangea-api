<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Creeper
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
        $this->name = "creeper";
        $this->maxHeight = rand(0, 1);
        $this->growthRate = rand(5, 25);
        $this->isSeasonal = true;
        $this->hasFruit = rand(0, 20) === 1 ? true : false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = true;

        $this->leafAppearance = "broad";
        $this->rainfallMin = rand(3, 5);
        $this->rainfallMax = $this->rainfallMin + rand(0, 5);
        $this->temperatureMin = rand(2, 6);
        $this->temperatureMax = $this->temperatureMin + rand(0, 2);
    }
}
