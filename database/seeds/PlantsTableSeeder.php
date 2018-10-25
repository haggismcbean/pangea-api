<?php

use Illuminate\Database\Seeder;

use App\WorldGenerator\PlantGenerator;
use App\Plant;

use App\Traits\PlantTypes\Broadleaf;
use App\Traits\PlantTypes\Cactus;
use App\Traits\PlantTypes\Climber;
use App\Traits\PlantTypes\Conifer;
use App\Traits\PlantTypes\Creeper;
use App\Traits\PlantTypes\Fern;
use App\Traits\PlantTypes\Grass;
use App\Traits\PlantTypes\LeafyBush;
use App\Traits\PlantTypes\Seaweed;
use App\Traits\PlantTypes\Shrub;
use App\Traits\PlantTypes\Succulent;
use App\Traits\PlantTypes\ThornyBush;

class PlantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Let's clear the location table first
        Plant::truncate();

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

        foreach ($plants as $plant) {
        	$plant = $plant->plant;
            DB::table('plants')->insert([
                'typeName' => $plant->type->name,
				'maxHeight' => $plant->type->maxHeight,
				'growthRate' => $plant->type->growthRate,
				'isSeasonal' => $plant->type->isSeasonal,
				'hasFruit' => $plant->type->hasFruit,
				'isPoisonous' => $plant->type->isPoisonous,
				'hasFlower' =>  $plant->type->hasFlower,
				'rainfallMin' =>  $plant->type->rainfallMin,
				'rainfallMax' =>  $plant->type->rainfallMax,
				'temperatureMin' =>  $plant->type->temperatureMin,
				'temperatureMax' =>  $plant->type->temperatureMax,
				'rotRate' => $plant->rotRate,
				'seedAppearance' => $plant->seedAppearance,
				'seedSize' => $plant->seedSize,
				'seedColor' => $plant->seedColor,
				'seedShape' => $plant->seedShape,
				'seedPattern' => $plant->seedPattern,
				'flowerAppearance' => $plant->flowerAppearance,
				'flowerSize' => $plant->flowerSize,
				'flowerColor' => $plant->flowerColor,
				'flowerShape' => $plant->flowerShape,
				'leafAppearance' =>$plant->leafAppearance, 
				'leafSize' => $plant->leafSize,
				'leafColor' => $plant->leafColor,
				'leafShape' => $plant->leafShape,
            ]);
        }
    }
}
