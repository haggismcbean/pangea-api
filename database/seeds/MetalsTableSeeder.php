<?php

use Illuminate\Database\Seeder;

use App\Metal;
use App\Item;

class MetalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Metal::truncate();

        Metal::create([
            'id' => 1,
            'name' => 'gold',
            'description' => 'shiny yellow metal',
        ]);
		
		Metal::create([
            'id' => 2,
            'name' => 'silver',
            'description' => 'shiny silver metal',
        ]);
		
		Metal::create([
            'id' => 3,
            'name' => 'copper',
            'description' => 'burnished metal',
        ]);
		
		Metal::create([
            'id' => 4,
            'name' => 'tin',
            'description' => 'pale silver metal',
        ]);
		
		Metal::create([
            'id' => 5,
            'name' => 'bronze',
            'description' => 'red metal',
        ]);
		
		Metal::create([
            'id' => 6,
            'name' => 'iron',
            'description' => 'cold grey metal',
        ]);
		
		Metal::create([
            'id' => 7,
            'name' => 'steel',
            'description' => 'shiny grey metal',
        ]);
		
		Metal::create([
            'id' => 8,
            'name' => 'lead',
            'description' => 'dull black metal',
        ]);

        Item::create([
        	'item_type' => 'metal',
        	'type_id' => 1,
        	'unit_weight' => 1200,
        	'unit_volume' => 10,
        	'rot_rate' => 100,
        	'efficiency' => 8,
            'name' => 'gold',
            'description' => 'shiny yellow metal',
        ]);
		
		Item::create([
        	'item_type' => 'metal',
        	'type_id' => 2,
        	'unit_weight' => 650,
        	'unit_volume' => 10,
        	'rot_rate' => 100,
        	'efficiency' => 8,
            'name' => 'silver',
            'description' => 'shiny silver metal',
        ]);
		
		Item::create([
        	'item_type' => 'metal',
        	'type_id' => 3,
        	'unit_weight' => 550,
        	'unit_volume' => 100,
        	'rot_rate' => 20,
        	'efficiency' => 25,
            'name' => 'copper',
            'description' => 'burnished metal',
        ]);
		
		Item::create([
        	'item_type' => 'metal',
        	'type_id' => 4,
        	'unit_weight' => 550,
        	'unit_volume' => 100,
        	'rot_rate' => 20,
        	'efficiency' => 8,
            'name' => 'tin',
            'description' => 'pale silver metal',
        ]);
		
		Item::create([
        	'item_type' => 'metal',
        	'type_id' => 5,
        	'unit_weight' => 510,
        	'unit_volume' => 70,
        	'rot_rate' => 60,
        	'efficiency' => 80,
            'name' => 'bronze',
            'description' => 'red metal',
        ]);
		
		Item::create([
        	'item_type' => 'metal',
        	'type_id' => 6,
        	'unit_weight' => 450,
        	'unit_volume' => 70,
        	'rot_rate' => 100,
        	'efficiency' => 150,
            'name' => 'iron',
            'description' => 'cold grey metal',
        ]);
		
		Item::create([
        	'item_type' => 'metal',
        	'type_id' => 7,
        	'unit_weight' => 490,
        	'unit_volume' => 70,
        	'rot_rate' => 100,
        	'efficiency' => 180,
            'name' => 'steel',
            'description' => 'shiny grey metal',
        ]);
		
		Item::create([
        	'item_type' => 'metal',
        	'type_id' => 8,
        	'unit_weight' => 550,
        	'unit_volume' => 70,
        	'rot_rate' => 30,
        	'efficiency' => 8,
            'name' => 'lead',
            'description' => 'dull black metal',
        ]);
    }
}
