<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ThornyBush
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
        $this->name = "thorny bush";
        $this->maxHeight = rand(10, 25);
        $this->growthRate = rand(0, 10);
        $this->isSeasonal = false;
        $this->hasFruit = rand(0, 50) === 1 ? true : false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = true;

        $this->leafAppearance = "thorn";
        $this->rainfallMin = 1;
        $this->rainfallMax = 3;
        $this->temperatureMin = 1;
        $this->temperatureMax = 6;
    }
}
