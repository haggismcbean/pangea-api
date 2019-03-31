<?php

use Illuminate\Database\Seeder;
use App\Location;
use App\Plant;

class LocationPlantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$locations = Location::where('biome', '!=', 'Ocean')->get();
    	$count = 0;

    	foreach ($locations as $location) {
    		$biome = $location->biome()->first();
    		$plants = $biome->plants()->get();

    		$plantDensity = $biome->plantDensity;

    		$count += count($plants);

    		foreach ($plants as $plant) {

    			DB::table('location_plant')->insert([
		            'location_id' => $location->id,
		            'plant_id' => $plant->id,
		            'count' => $plantDensity * rand(5, 50)
		        ]);
    		}
    	}
    }
}
