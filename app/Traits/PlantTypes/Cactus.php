<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cactus
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
        $this->name = "cactus";
        $this->maxHeight = rand(3, 20);
        $this->growthRate = rand(0, 5);
        $this->isSeasonal = true;
        $this->hasFruit = rand(0, 20) === 1 ? true : false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = true;

        $this->leafAppearance = "thorn";
        $this->rainfallMin = 0;
        $this->rainfallMax = 2;
        $this->temperatureMin = 5;
        $this->temperatureMax = 6;
    }
}
