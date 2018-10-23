<?php

namespace App\Traits\BiomeTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\BiomeTypes\Biome;

class SubpolarWetTundra extends Biome
    //"rainfall": 2,
    //"temperature": 1,
{
    public $name;
    public $sproutRainfall;
    public $sproutTemperature;
    public $deathRainfall;
    public $deathTemperature;

    public function __construct()
    {
        $this->name = "Subpolar Wet Tundra";
        $this->sproutRainfall = 2;
        $this->sproutTemperature = 2;
        $this->deathRainfall = 0;
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
