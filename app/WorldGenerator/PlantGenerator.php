<?php

namespace App\WorldGenerator;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\PlantFactory;
use Auth;

class PlantGenerator
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->plant = new PlantFactory($type);
    }
}