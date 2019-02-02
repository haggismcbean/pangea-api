<?php

namespace App\Traits\AnimalTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PredatorMammal
{
    public $name;
    public $maxSize; // 0-100
    public $growthRate; // 0-100

    // appearance
    public $hasHorn;
    public $hasFur;
    public $hasHide;
    public $hasFeathers;
    public $isPoisonous;

    // behaviour
    public $isMeatEater;
    public $isPlantEater;
    public $isScavenger;

    public $isHumanEater;
    public $fearOfHumans; // 0-9
    public $isPest;

    public $maxHerdSize; // biome effects this
    public $maxSpeed; // biome effects this
    public $fleeDistance; // how close a human can get before it flees
    public $canHide;

    public $hasHole;

    public $isNocturnal;

    public $isBeastOfBurden;
    public $isDomesticatable;

    public function __construct()
    {
        $this->name = "predator";
        $this->maxSize = rand(10, 40);
        $this->growthRate = rand(1, 5);

        $this->hasHorn = false;
        $this->hasFur = true;
        $this->hasHide = true;
        $this->hasFeathers = false;
        $this->isPoisonous = false;

        $this->isMeatEater = true;
        $this->isPlantEater = false;
        $this->isScavenger = rand(0, 1) === 1 ? true: false;

        $this->isHumanEater = rand(0, 7) === 1 ? true: false;
        $this->fearOfHumans = rand(0, 9);
        $this->isPest = false;

        $this->maxHerdSize = rand(0, 1) === 1 ? 1 : rand(3,10);
        $this->maxSpeed = rand(0, 8);
        $this->fleeDistance = $this->fearOfHumans ? rand(1, 9) : 0;
        $this->canHide = true;

        $this->hasHole = rand(0, 8) === 1 ? true: false;

        $this->isNocturnal = rand(0, 5) === 1 ? true: false;

        $this->isBeastOfBurden = false;
        $this->isDomesticatable = false;
    }
}
