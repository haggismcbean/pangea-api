<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Succulent
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
        $this->name = "succulent";
        $this->maxHeight = rand(0, 5);
        $this->growthRate = rand(0, 4);
        $this->isSeasonal = false;
        $this->hasFruit = false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = false;

        $this->leafAppearance = "succulent";
        $this->rainfallMin = rand(1, 2);
        $this->rainfallMax = $this->rainfallMin + rand(0 ,2);
        $this->temperatureMin = rand(5, 6);
        $this->temperatureMax = $this->temperatureMin + rand(0, 2);
    }
}
