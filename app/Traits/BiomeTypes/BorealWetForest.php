<?php

namespace App\Traits\BiomeTypes;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BiomeTypes\Biome;
use Carbon\Carbon;

class BorealWetForest extends Biome
    //"rainfall": 3,
    //"temperature": 2,
{
    public $name;
    public $sproutRainfall;
    public $sproutTemperature;
    public $deathRainfall;
    public $deathTemperature;

    public function __construct()
    {
        $this->name = "Boreal Wet Forest";
        $this->sproutRainfall = 2;
        $this->sproutTemperature = 2;
        $this->deathRainfall = 1;
        $this->deathTemperature = rand(0, 1);
    }

    public function getRandomPlantType()
    {
        $conifer = new Conifer();
        $shrub = new Shrub();
        $fern = new Fern();
        $this->type = $this->getRandomType([$conifer, $shrub, $fern]);
        break;
    }
}
