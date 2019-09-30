<?php

use Illuminate\Database\Seeder;
use App\LocationPlant;
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
        LocationPlant::truncate();

    	$locations = Location::where('biome', '!=', 'Ocean')->get();
    	$count = 0;

    	foreach ($locations as $location) {
    		$biome = $location->biome()->first();
    		$plants = $biome->plants()->get();

    		$plantDensity = $biome->plantDensity;

            // to do - sum up all the edible plants in the biome.
            $ediblePlantsCount = 0;
            $ediblePlantsCount += $plants->where('leafUse', 'food')->count();
            $ediblePlantsCount += $plants->where('seedUse', 'food')->count();
            $ediblePlantsCount += $plants->where('flowerUse', 'food')->count();
            $ediblePlantsCount += $plants->where('fruitUse', 'food')->count();
            $ediblePlantsCount += $plants->where('stalkUse', 'food')->count();
            $ediblePlantsCount += $plants->where('rootUse', 'food')->count();

    		$count += count($plants);

    		foreach ($plants as $plant) {

    			DB::table('location_plant')->insert([
		            'location_id' => $location->id,
		            'plant_id' => $plant->id,
		            'count' => $plantDensity * rand(5, 50),
                    'gathered_this_year' => 0,
                    'todays_remaining_yield' => 0
		        ]);

			if ($plant->leafUse === 'food'
				|| $plant->seedUse === 'food'
				|| $plant->flowerUse === 'food'
				|| $plant->fruitUse === 'food'
				|| $plant->stalkUse === 'food'
				|| $plant->rootUse === 'food') {


                		$plant->yearly_yield = ($biome->averageHunterGathererYield / 2 / $ediblePlantsCount) + rand(0, 10);
                		$plant->yield_per_item = $plant->yearly_yield / (20 + rand(0, 10));
                		$plant->max_plants_in_farm = $biome->averageArableYield / $plant->yearly_yield;
                		$plant->save();
			}
    		}
    	}
    }
}
