<?php

namespace App\Traits\BiomeTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SubpolarDryTundra
    //"rainfall": 0,
    //"temperature": 1,
{
    public $name;
    public $sproutRainfall;
    public $sproutTemperature;
    public $deathRainfall;
    public $deathTemperature;

    public function __construct()
    {
        $this->name = "Subpolar Dry Tundra";
        $this->sproutRainfall = 1;
        $this->sproutTemperature = 2;
        $this->deathRainfall = 0;
        $this->deathTemperature = rand(0, 1);
    }

    public function getRandomPlantType()
    {
        $shrub = new Shrub();
        $grass = new Grass();
        return $this->getRandomType([$shrub, $grass]);
    }
}
