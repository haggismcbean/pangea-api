<?php

namespace App\WorldGenerator;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

// biome types
use App\Traits\BiomeTypes\Ocean;
use App\Traits\BiomeTypes\SubpolarDryTundra;

class Plant extends Model
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$biome = new SubpolarDryTundra();
        $this->plant = new PlantFactory($biome);
    }
}