<?php

use Illuminate\Database\Seeder;
use App\LocationItem;
use App\Location;
use App\Stone;

class LocationItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LocationItem::truncate();

        $locations = Location::where('biome', '!=', 'Ocean')->get();
        $locationCount = Location::where('biome', '!=', 'Ocean')->count();

        $sedimentaryStones = Stone::where('layer', 'sedimentary')->where('rarity', 2000)->get();
        $igneousExtrusiveStones = Stone::where('layer', 'igneous extrusive')->where('rarity', 2000)->get();
        $metamorphicStones = Stone::where('layer', 'metamorphic')->where('rarity', 2000)->get();
        $igneousIntrusiveStones = Stone::where('layer', 'igneous intrusive')->where('rarity', 2000)->get();
        $rareStones = Stone::where('rarity', '!=', 2000)->get();

    	foreach ($locations as $location) {
    		//random sedimentary stone
			DB::table('location_items')->insert([
	            'location_id' => $location->id,
	            'item_id' => $this->getRandomStone($sedimentaryStones)->id,
	            'item_type' => 'stone',
	            'quantity' => 3000
	        ]);

    		//random igneous extrusive stone
			DB::table('location_items')->insert([
	            'location_id' => $location->id,
	            'item_id' => $this->getRandomStone($igneousExtrusiveStones)->id,
	            'item_type' => 'stone',
	            'quantity' => 3000
	        ]);

    		//random metamorphic stone
			DB::table('location_items')->insert([
	            'location_id' => $location->id,
	            'item_id' => $this->getRandomStone($metamorphicStones)->id,
	            'item_type' => 'stone',
	            'quantity' => 3000
	        ]);

    		//random igneous intrusive stone
			DB::table('location_items')->insert([
	            'location_id' => $location->id,
	            'item_id' => $this->getRandomStone($igneousIntrusiveStones)->id,
	            'item_type' => 'stone',
	            'quantity' => 3000
	        ]);

	        foreach($rareStones as $rareStone) {
	        	if ($this->isRareStoneHere($rareStone, $locationCount)) {
		    		//random rare stone
					DB::table('location_items')->insert([
			            'location_id' => $location->id,
			            'item_id' => $rareStone->id,
			            'item_type' => 'stone',
			            'quantity' => rand(200, 500)
			        ]);
	        	}
	        }
    	}
    }

    private function getRandomStone($stones) {
    	$length = count($stones) - 1;
        $randomIndex = rand(0, $length);
        return $stones[$randomIndex];
    }

    private function isRareStoneHere($stone, $locationCount) {
    	$chanceOfOccurring = $stone->rarity / $locationCount * 100;
    	$randomIndex = rand(0, $locationCount);

    	if ($randomIndex < $chanceOfOccurring) {
    		return true;
    	} else {
    		return false;
    	}
    }
}
