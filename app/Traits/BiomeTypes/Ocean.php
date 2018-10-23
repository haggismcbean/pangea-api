<?php

namespace App\Traits\BiomeTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

// plant types
use App\Traits\PlantTypes\Seaweed;

class Ocean
    //"rainfall": any,
    //"temperature": any,
{
    public $name;
    public $sproutRainfall;
    public $sproutTemperature;
    public $deathRainfall;
    public $deathTemperature;

    public function __construct()
    {
        $this->name = "Ocean";
        $this->sproutRainfall = rand(0, 7);
        $this->sproutTemperature = rand(0, 8) > 3 ? true : false;
        $this->deathRainfall = rand(0, 7) < 3 ? true : false;;
        $this->deathTemperature = 2;
    }

    public function getRandomPlantType()
    {
        return new Seaweed();
    }
}
