<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WorldGenerator\PlantGenerator;

use App\Traits\PlantTypes\Seaweed;
use App\Traits\PlantTypes\Broadleaf;
use App\Traits\PlantTypes\Cactus;
use App\Traits\PlantTypes\Climber;
use App\Traits\PlantTypes\Conifer;
use App\Traits\PlantTypes\Creeper;
use App\Traits\PlantTypes\Fern;
use App\Traits\PlantTypes\Grass;
use App\Traits\PlantTypes\LeafyBush;
use App\Traits\PlantTypes\Shrub;
use App\Traits\PlantTypes\Succulent;
use App\Traits\PlantTypes\ThornyBush;

class PlantController extends Controller
{

    public function show() {
    	$plants = [];

        for ($i=0; $i < 100; $i++) { 
        	$type = new Broadleaf();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 20; $i++) { 
        	$type = new Cactus();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 50; $i++) { 
        	$type = new Climber();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 50; $i++) { 
        	$type = new Conifer();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 20; $i++) { 
        	$type = new Creeper();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 20; $i++) { 
        	$type = new Fern();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 70; $i++) { 
        	$type = new Grass();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 60; $i++) { 
        	$type = new LeafyBush();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 60; $i++) { 
        	$type = new LeafyBush();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 20; $i++) { 
        	$type = new Seaweed();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 60; $i++) { 
        	$type = new Shrub();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 60; $i++) { 
        	$type = new Succulent();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }

        for ($i=0; $i < 60; $i++) { 
        	$type = new ThornyBush();
        	$plant = new PlantGenerator($type);
        	array_push($plants, $plant);
        }
        return response()->json($plants);
    }
}