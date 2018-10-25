<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Conifer
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
        $this->name = "conifer";
        $this->maxHeight = rand(40, 90);
        $this->growthRate = rand(0, 15);
        $this->isSeasonal = false;
        $this->hasFruit = rand(0, 20) === 1 ? true : false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = false;

        $this->leafAppearance = "needle";
        $this->rainfallMin = 1;
        $this->rainfallMax = 4;
        $this->temperatureMin = 0;
        $this->temperatureMax = 3;
    }
}
