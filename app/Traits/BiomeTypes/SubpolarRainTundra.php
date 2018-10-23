<?php

namespace App\Traits\BiomeTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SubpolarRainTundra
    //"rainfall": 3,
    //"temperature": 1,
{
    public $name;
    public $sproutRainfall;
    public $sproutTemperature;
    public $deathRainfall;
    public $deathTemperature;

    public function __construct()
    {
        $this->name = "Subpolar Rain Tundra";
        $this->sproutRainfall = 2;
        $this->sproutTemperature = 2;
        $this->deathRainfall = 1;
        $this->deathTemperature = rand(0, 1);
    }

    public function getRandomPlantType()
    {
        $shrub = new Shrub();
        $grass = new Grass();
        $this->type = $this->getRandomType([$shrub, $grass]);
        break;
    }
}
