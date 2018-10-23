<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Grass
{
    public $probability;
    public $name;
    public $maxHeight;
    public $growthRate;
    public $isSeasonal;
    public $hasFruit;
    public $isPoisonous;
    public $hasFlower;
    public $leafAppearance;

    public function __construct()
    {
        $this->probability = 20;
        $this->name = "grass";
        $this->maxHeight = rand(0, 10);
        $this->growthRate = rand(0, 25);
        $this->isSeasonal = true;
        $this->hasFruit = false;
        $this->isPoisonous = rand(0, 20) === 1 ? true : false;
        $this->hasFlower = false;
    }
}
