<?php

namespace App\Traits\AnimalTypes;

use App\Traits\AnimalTypes\AnimalType;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PreyBird extends AnimalType
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
        $this->name = "bird";
        $this->maxSize = rand(1, 20);
        $this->sizeString = $this->getSizeString($this->maxSize);
        $this->growthRate = rand(4, 5);

        $this->hasHorn = false;
        $this->hasFur = false;
        $this->hasHide = false;
        $this->hasFeathers = true;
        $this->isPoisonous = false;

        $this->isMeatEater = false;
        $this->isPlantEater = true;
        $this->isScavenger = false;

        $this->isHumanEater = false;
        $this->fearOfHumans = rand(0, 9);
        $this->isPest = rand(0, 9) === 1 ? true: false;

        $this->maxHerdSize = rand(0, 1) === 1 ? 1 : rand(5,20);
        $this->maxSpeed = rand(0, 8);
        $this->fleeDistance = $this->fearOfHumans ? rand(1, 9) : 0;
        $this->canHide = false;

        $this->hasHole = false;

        $this->isNocturnal = false;

        $this->isBeastOfBurden = false;
        $this->isDomesticatable = false;
    }
}
