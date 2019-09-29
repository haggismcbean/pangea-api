<?php

use Illuminate\Database\Seeder;
use App\Location;
use App\Biome;
use App\Plant;
use App\WorldGenerator\World;

class LocationTableSecondarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the location table first
        //Location::truncate();

        $locations = Location::get();

        foreach ($locations as $location) {
            $biome = Biome::where('temperature', $location->temperature)->where('rainfall', $location->rainfall)->where('name', '!=', 'Ocean')->first();
            $location->biome_id = $biome->id;
	    $location->yearly_animal_yield = $biome->averageHunterGathererYield / 2;
	    $location->save();
        }
    }
}
