<?php

namespace App\Traits\AnimalTypes;

use App\Traits\AnimalTypes\AnimalType;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fish extends AnimalType
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
        $this->name = "fish";
        $this->maxSize = rand(1, 10);
        $this->sizeString = $this->getSizeString($this->maxSize);
        $this->growthRate = rand(1, 5);

        $this->hasHorn = false;
        $this->hasFur = false;
        $this->hasHide = false;
        $this->hasFeathers = false;
        $this->isPoisonous = rand(1, 10) === 10 ? true : false;

        $this->isMeatEater = false;
        $this->isPlantEater = true;
        $this->isScavenger = false;

        $this->isHumanEater = false;
        $this->fearOfHumans = rand(6, 9);
        $this->isPest = false;

        $this->maxHerdSize = rand(0, 1) === 1 ? 1 : rand(3,30);
        $this->maxSpeed = rand(6, 9);
        $this->fleeDistance = rand(6, 9);
        $this->canHide = false;

        $this->hasHole = false;

        $this->isNocturnal = false;

        $this->isBeastOfBurden = false;
        $this->isDomesticatable = false;
    }
}
