<?php

use Illuminate\Database\Seeder;

use App\WorldGenerator\AnimalGenerator;
use App\Animal;

class AnimalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Animal::truncate();

        $animals = [];

        for ($temperature=2; $temperature < 7; $temperature++) {
            for ($rainfall=2; $rainfall < 8; $rainfall++) { 
                $deer = new AnimalGenerator("deer");
                $deer->animal->temperatureMin = $temperature;
                $deer->animal->temperatureMax = $temperature;
                $deer->animal->rainfallMin = $rainfall;
                $deer->animal->rainfallMax = $rainfall;

                array_push($animals, $deer);
            }
        }

        for ($temperature=2; $temperature < 7; $temperature++) {
            for ($rainfall=2; $rainfall < 8; $rainfall++) { 
                $predatorMammal = new AnimalGenerator("predator-mammal");
                $predatorMammal->animal->temperatureMin = $temperature;
                $predatorMammal->animal->temperatureMax = $temperature;
                $predatorMammal->animal->rainfallMin = $rainfall;
                $predatorMammal->animal->rainfallMax = $rainfall;

                array_push($animals, $predatorMammal);
            }
        }

        for ($temperature=2; $temperature < 7; $temperature++) {
            for ($rainfall=2; $rainfall < 8; $rainfall++) { 
                $preyBird = new AnimalGenerator("prey-bird");
                $preyBird->animal->temperatureMin = $temperature;
                $preyBird->animal->temperatureMax = $temperature;
                $preyBird->animal->rainfallMin = $rainfall;
                $preyBird->animal->rainfallMax = $rainfall;

                array_push($animals, $preyBird);
            }
        }

        for ($temperature=0; $temperature < 7; $temperature++) {
            for ($rainfall=0; $rainfall < 8; $rainfall++) { 
                $fish = new AnimalGenerator("fish");
                $fish->animal->temperatureMin = $temperature;
                $fish->animal->temperatureMax = $temperature;
                $fish->animal->rainfallMin = $rainfall;
                $fish->animal->rainfallMax = $rainfall;

                array_push($animals, $fish);
            }
        }

        foreach ($animals as $animal) {
            $animal = $animal->animal;
            DB::table('animals')->insert([
                'name' => $animal->stats->name,
                'maxSize' => $animal->stats->maxSize,
                'sizeString' => $animal->stats->sizeString,
                'growthRate' => $animal->stats->growthRate,
                'hasHorn' => $animal->stats->hasHorn,
                'hasFur' => $animal->stats->hasFur,
                'hasHide' =>  $animal->stats->hasHide,
                'hasFeathers' =>  $animal->stats->hasFeathers,
                'isPoisonous' =>  $animal->stats->isPoisonous,
                'isMeatEater' =>  $animal->stats->isMeatEater,
                'isPlantEater' =>  $animal->stats->isPlantEater,
                'isScavenger' => $animal->stats->isScavenger,
                'isHumanEater' => $animal->stats->isHumanEater,
                'fearOfHumans' => $animal->stats->fearOfHumans,
                'isPest' => $animal->stats->isPest,
                'maxHerdSize' => $animal->stats->maxHerdSize,
                'maxSpeed' => $animal->stats->maxSpeed,
                'fleeDistance' => $animal->stats->fleeDistance,
                'canHide' => $animal->stats->canHide,
                'hasHole' => $animal->stats->hasHole,
                'isNocturnal' => $animal->stats->isNocturnal,
                'isBeastOfBurden' =>$animal->stats->isBeastOfBurden, 
                'isDomesticatable' => $animal->stats->isDomesticatable,
                'temperatureMin' => $animal->temperatureMin,
                'temperatureMax' => $animal->temperatureMax,
                'rainfallMin' => $animal->rainfallMin,
                'rainfallMax' => $animal->rainfallMax,
                'furAppearance' => $animal->furAppearance,
                'legAppearance' => $animal->legAppearance,
                'feathersAppearance' => $animal->feathersAppearance,
                'scalesAppearance' => $animal->scalesAppearance,
                'postureAppearance' => $animal->postureAppearance,
            ]);
        }
    }
}
