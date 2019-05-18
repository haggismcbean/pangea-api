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

            // okay cool. now for the minerals!!
            if ($location->rainfall > 2 && $location->temperature > 2) {
                // fresh water
                DB::table('location_items')->insert([
                    'location_id' => $location->id,
                    'item_id' => 9,
                    'item_type' => 'mineral',
                    'quantity' => 3000
                ]);
                
                // peat
                if (rand(0, 20) < 2) {
                    DB::table('location_items')->insert([
                        'location_id' => $location->id,
                        'item_id' => 5,
                        'item_type' => 'mineral',
                        'quantity' => 3000
                    ]);
                }

                // clay
                if (rand(0, 10) < 2) {
                    DB::table('location_items')->insert([
                        'location_id' => $location->id,
                        'item_id' => 1,
                        'item_type' => 'mineral',
                        'quantity' => 3000
                    ]);
                }
                
                // soil
                DB::table('location_items')->insert([
                    'location_id' => $location->id,
                    'item_id' => 7,
                    'item_type' => 'mineral',
                    'quantity' => 3000
                ]);
            }

            // okay cool. now for the minerals!!
            if ($location->rainfall < 2 && $location->temperature > 5) {
                // sand
                DB::table('location_items')->insert([
                    'location_id' => $location->id,
                    'item_id' => 3,
                    'item_type' => 'mineral',
                    'quantity' => 3000
                ]);
            }

            // random but rare
            // salt
            if (rand(0, 400) < 2) {
                DB::table('location_items')->insert([
                    'location_id' => $location->id,
                    'item_id' => 8,
                    'item_type' => 'mineral',
                    'quantity' => 3000
                ]);
            }

            // salt water
            if (rand(0, 200) < 2) {
                DB::table('location_items')->insert([
                    'location_id' => $location->id,
                    'item_id' => 10,
                    'item_type' => 'mineral',
                    'quantity' => 3000
                ]);
            }

            // obsidian
            if (rand(0, 2000) < 2) {
                DB::table('location_items')->insert([
                    'location_id' => $location->id,
                    'item_id' => 2,
                    'item_type' => 'mineral',
                    'quantity' => 3000
                ]);
            }

            // oil
            if (rand(0, 2000) < 2) {
                DB::table('location_items')->insert([
                    'location_id' => $location->id,
                    'item_id' => 4,
                    'item_type' => 'mineral',
                    'quantity' => 3000
                ]);
            }

            // coal
            if (rand(0, 300) < 2) {
                DB::table('location_items')->insert([
                    'location_id' => $location->id,
                    'item_id' => 6,
                    'item_type' => 'mineral',
                    'quantity' => 3000
                ]);
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
