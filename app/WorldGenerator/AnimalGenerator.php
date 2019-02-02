<?php

namespace App\WorldGenerator;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Factories\AnimalFactory;
use Auth;

class AnimalGenerator
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->animal = new AnimalFactory($type);
    }
}