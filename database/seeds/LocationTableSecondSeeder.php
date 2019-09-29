<?php

use Illuminate\Database\Seeder;

use App\Location;
use App\Biome;

class LocationTableSecondSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = Location::where('biome', '!=', 'Ocean')->get();

	foreach($locations as $location) {
	    $biome = Biome::where('rainfall', $location->rainfall)->where('temperature', $location->temperature)->where('name', '!=', 'Ocean')->first();

	    $location->biome_id = $biome->id;
	    $location->yearly_animal_yield = $biome->averageHunterGathererYield / 2;
	    $location->save();
	}
    }
}
