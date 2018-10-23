<?php

namespace App\Traits\PlantTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Shrub
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
        $this->name = "shrub";
        $this->maxHeight = rand(0, 5);
        $this->growthRate = rand(0, 15);
        $this->isSeasonal = true;
        $this->hasFruit = rand(0, 20) === 1 ? true : false;
        $this->isPoisonous = rand(0, 7) === 1 ? true : false;
        $this->hasFlower = true;
    }
}
