<?php

namespace App\Traits\BiomeTypes;

use App\Traits\BiomeTypes\Biome;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SubtropicalMoistForest extends Biome
{
    public $name;
    public $sproutRainfall;
    public $sproutTemperature;
    public $deathRainfall;
    public $deathTemperature;

    public function __construct()
    {
        $this->name = "Subtropical Moist Forest";
        $this->sproutRainfall = 2;
        $this->sproutTemperature = 2;
        $this->deathRainfall = 1;
        $this->deathTemperature = rand(0, 1);
    }

    public function getRandomPlantType()
    {
        $conifer = new Conifer();
        $broadleaf = new Broadleaf();
        $grass = new Grass();
        $shrub = new Shrub();
        $fern = new Fern();
        $bush = new Bush();
        $this->type = $this->getRandomType([$conifer, $broadleaf, $grass, $shrub, $fern, $bush]);
        break;
    }
}
