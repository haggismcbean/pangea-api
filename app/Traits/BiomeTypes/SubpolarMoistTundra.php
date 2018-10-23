<?php

namespace App\Traits\BiomeTypes;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BiomeTypes\Biome;
use Carbon\Carbon;

class SubpolarMoistTundra extends Biome
    //"rainfall": 1,
    //"temperature": 1,
{
    public $name;
    public $sproutRainfall;
    public $sproutTemperature;
    public $deathRainfall;
    public $deathTemperature;

    public function __construct()
    {
        $this->name = "Subpolar Moist Tundra";
        $this->sproutRainfall = 1;
        $this->sproutTemperature = 2;
        $this->deathRainfall = 0;
        $this->deathTemperature = rand(0, 1);
    }

    public function getRandomPlantType()
    {
        $shrub = new Shrub();
        $grass = new Grass();
        $fern = new Fern();
        $this->type = $this->getRandomType([$shrub, $grass, $fern]);
    }
}
