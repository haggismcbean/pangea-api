<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Seaweed
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
        $this->name = "seaweed";
        $this->maxHeight = rand(0, 20);
        $this->growthRate = rand(0, 10);
        $this->isSeasonal = true;
        $this->hasFruit = rand(0, 20) === 1 ? true : false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = false;
        $this->hasWood = false;

        $this->rainfallMin = rand(0, 8);
        $this->rainfallMax = $this->rainfallMin + rand(0, 8);
        $this->temperatureMin = rand(0, 8);
        $this->temperatureMax = $this->temperatureMin + rand(0, 8);
    }
}
