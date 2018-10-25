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

    public $rainfallMin;
    public $rainfallMax;
    public $temperatureMin;
    public $temperatureMax;

    public function __construct()
    {
        $this->name = "fern";
        $this->maxHeight = rand(0, 5);
        $this->growthRate = rand(5, 15);
        $this->isSeasonal = true;
        $this->hasFruit = false;
        $this->isPoisonous = false;
        $this->hasFlower = false;

        $this->leafAppearance = "fern";
        $this->rainfallMin = 3;
        $this->rainfallMax = 7;
        $this->temperatureMin = 1;
        $this->temperatureMax = 6;
    }
}
