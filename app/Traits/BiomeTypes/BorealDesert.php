<?php

namespace App\Traits\BiomeTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BorealDesert
    //"rainfall": 0,
    //"temperature": 2, 
{
    public $name;
    public $sproutRainfall;
    public $sproutTemperature;
    public $deathRainfall;
    public $deathTemperature;

    public function __construct()
    {
        $this->name = "Boreal Desert";
        $this->sproutRainfall = 1;
        $this->sproutTemperature = 2;
        $this->deathRainfall = 0;
        $this->deathTemperature = rand(0, 1);
    }

    public function getRandomPlantType()
    {
        $grass = new Grass();
        $shrub = new Shrub();
        $this->type = $this->getRandomType([$shrub, $grass]);
        break;
    }
}
