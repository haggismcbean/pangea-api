<?php

namespace App\Traits\BiomeTypes;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BiomeTypes\Biome;
use Carbon\Carbon;

class BorealMoistForest extends Biome
    //"rainfall": 2,
    //"temperature": 2,
{
    public $name;
    public $sproutRainfall;
    public $sproutTemperature;
    public $deathRainfall;
    public $deathTemperature;

    public function __construct()
    {
        $this->name = "Boreal Moist Forest";
        $this->sproutRainfall = 1;
        $this->sproutTemperature = 2;
        $this->deathRainfall = 0;
        $this->deathTemperature = rand(0, 1);
    }

    public function getRandomPlantType()
    {
        $conifer = new Conifer();
        $shrub = new Shrub();
        $grass = new Grass();
        $fern = new Fern();
        $this->type = $this->getRandomType([$conifer, $shrub, $grass, $fern]);
        break;
    }
}
