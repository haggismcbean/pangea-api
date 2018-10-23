<?php

namespace App\Traits\BiomeTypes;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BiomeTypes\Biome;
use Carbon\Carbon;

class BorealDryScrub extends Biome
    //"rainfall": 1,
    //"temperature": 2,
{
    public $name;
    public $sproutRainfall;
    public $sproutTemperature;
    public $deathRainfall;
    public $deathTemperature;

    public function __construct()
    {
        $this->name = "Boreal Dry Scrub";
        $this->sproutRainfall = 1;
        $this->sproutTemperature = rand(3,4);
        $this->deathRainfall = 0;
        $this->deathTemperature = rand(0, 1);
    }

    public function getRandomPlantType()
    {
        $grass = new Grass();
        $shrub = new Shrub();
        $this->type = $this->getRandomType([$grass, $fern]);
    }
}
