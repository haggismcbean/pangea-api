<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LeafyBush
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
        $this->name = "leafy bush";
        $this->maxHeight = rand(10, 25);
        $this->growthRate = rand(10, 15);
        $this->isSeasonal = true;
        $this->hasFruit = rand(0, 20) === 1 ? true : false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = rand(0, 1) === 1 ? true : false;
        $this->hasWood = false;

        $this->leafAppearance = "broad";
        $this->rainfallMin = rand(4, 6);
        $this->rainfallMax = $this->rainfallMin + rand(0, 4);
        $this->temperatureMin = rand(3, 5);
        $this->temperatureMax = $this->temperatureMin + rand(0, 6);
    }
}
