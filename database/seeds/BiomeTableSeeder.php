<?php

use Illuminate\Database\Seeder;
use App\WorldGenerator\BiomeGenerator;
use App\Biome;
use App\Location;

class BiomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Biome::truncate();

    	$biomes = [];

        for ($averageRainfall=0; $averageRainfall < 8; $averageRainfall++) { 
        	for ($averageTemperature=0; $averageTemperature < 7; $averageTemperature++) {
        		$name = Location::where('temperature', $averageTemperature)->where('rainfall', $averageRainfall)->where('biome', '!=', 'Ocean')->first();
        		if ($name) {
	        		$biome = new BiomeGenerator($name->biome, $averageTemperature, $averageRainfall);
	        		array_push($biomes, $biome);

                    $biome = new BiomeGenerator('Ocean', $averageTemperature, $averageRainfall);
                    array_push($biomes, $biome);
        		}
        	}
        }

        foreach ($biomes as $biome) {
    		DB::table('biomes')->insert([
                'name' => $biome->name,
				'rainfall' => $biome->rainfall,
				'temperature' => $biome->temperature,
				'highestRainfall' => $biome->highestRainfall,
				'hottestTemperature' => $biome->hottestTemperature,
				'lowestRainfall' => $biome->lowestRainfall,
				'coldestTemperature' =>  $biome->coldestTemperature,
				'plantDensity' =>  $biome->plantDensity,
            ]);
        }
        		
    }
}
