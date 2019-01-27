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
    public $hasWood;
    public $woodAppearance;

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
        $this->hasWood = true;

        $this->leafAppearance = "needle";
        $this->rainfallMin = rand(1, 3);
        $this->rainfallMax = $this->rainfallMin + rand(0, 2);
        $this->temperatureMin = rand(0, 2);
        $this->temperatureMax = $this->temperatureMin + rand(0, 2);
    }
}
