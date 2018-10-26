<?php

use Illuminate\Database\Seeder;
use App\Biome;
use App\Plant;

class BiomePlantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$biomes = Biome::get();

        //for each biome, find out which plants can be contained in them, and then that's an entry
        foreach ($biomes as $biome) {
            if ($biome->name == 'Ocean') {
                continue;
            }

            $seasonalPlants = Plant::where('temperatureMin', '<=', $biome->temperature + 1)
                                    ->where('temperatureMax', '>=', $biome->hottestTemperature)
                                    ->where('rainfallMin', '<=', $biome->highestRainfall)
                                    ->where('rainfallMax', '>=', $biome->highestRainfall)
                                    ->where('isSeasonal', 1)->get();

            $yearRoundPlants = Plant::where('temperatureMin', '>=', $biome->coldestTemperature)
                                    ->where('temperatureMax', '<=', $biome->hottestTemperature)
                                    ->where('rainfallMin', '<=', $biome->lowestRainfall)
                                    ->where('rainfallMax', '>=', $biome->highestRainfall)
                                    ->where('isSeasonal', 0)->get();

            foreach ($seasonalPlants as $plant) {
                // if ($plant->typeName === 'Seaweed') {
                    // continue;
                // }

                $this->insertDbEntry($biome, $plant);
            }

            foreach ($yearRoundPlants as $plant) {
                // if ($plant->typeName === 'Seaweed') {
                    // continue;
                // }

                $this->insertDbEntry($biome, $plant);
            }
        }
    }

    private function insertDbEntry($biome, $plant) {
        DB::table('biome_plant')->insert([
            'biome_id' => $biome->id,
            'plant_id' => $plant->id,
        ]);
    }
}