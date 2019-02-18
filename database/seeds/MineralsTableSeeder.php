<?php

use Illuminate\Database\Seeder;

use App\Mineral;
use App\Item;

class MineralsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mineral::truncate();
        Item::truncate();

        Mineral::create([
            'id' => 1,
            'name' => 'clay',
            'description' => 'pale grey mud',
        ]);

		Mineral::create([
            'id' => 2,
            'name' => 'obsidian',
            'description' => 'hard glass like material',
        ]);

		Mineral::create([
            'id' => 3,
            'name' => 'sand',
            'description' => 'small grains of stone',
        ]);

		Mineral::create([
            'id' => 4,
            'name' => 'oil',
            'description' => 'black liquid',
        ]);

		Mineral::create([
            'id' => 5,
            'name' => 'peat',
            'description' => 'oily mud',
        ]);

		Mineral::create([
            'id' => 6,
            'name' => 'coal',
            'description' => 'black crystalline stone',
        ]);

		Mineral::create([
            'id' => 7,
            'name' => 'soil',
            'description' => 'brown earth',
        ]);

		Mineral::create([
            'id' => 8,
            'name' => 'salt',
            'description' => 'white grains',
        ]);

		Mineral::create([
            'id' => 9,
            'name' => 'fresh water',
            'description' => 'water',
        ]);

		Mineral::create([
            'id' => 10,
            'name' => 'salt water',
            'description' => 'salty water',
        ]);

        Item::create([
        	'item_type' => 'mineral',
        	'type_id' => 1,
        	'unit_weight' => 120,
        	'unit_volume' => 70,
        	'rot_rate' => 100,
        	'efficiency' => 1,
            'name' => 'clay',
            'description' => 'pale grey mud',
        ]);

		Item::create([
            'item_type' => 'mineral',
            'type_id' => 2,
            'unit_weight' => 100,
            'unit_volume' => 1,
            'rot_rate' => 50,
            'efficiency' => 30,
            'name' => 'obsidian',
            'description' => 'hard glass like material',
        ]);

		Item::create([
            'item_type' => 'mineral',
            'type_id' => 3,
            'unit_weight' => 112,
            'unit_volume' => 1,
            'rot_rate' => 100,
            'efficiency' => 1,
            'name' => 'sand',
            'description' => 'small grains of stone',
        ]);

		Item::create([
            'item_type' => 'mineral',
            'type_id' => 4,
            'unit_weight' => 60,
            'unit_volume' => 1,
            'rot_rate' => 100,
            'efficiency' => 1,
            'name' => 'oil',
            'description' => 'black liquid',
        ]);

		Item::create([
            'item_type' => 'mineral',
            'type_id' => 5,
            'unit_weight' => 75,
            'unit_volume' => 1,
            'rot_rate' => 100,
            'efficiency' => 1,
            'name' => 'peat',
            'description' => 'oily mud',
        ]);

		Item::create([
            'item_type' => 'mineral',
            'type_id' => 6,
            'unit_weight' => 60,
            'unit_volume' => 1,
            'rot_rate' => 100,
            'efficiency' => 1,
            'name' => 'coal',
            'description' => 'black crystalline stone',
        ]);

		Item::create([
            'item_type' => 'mineral',
            'type_id' => 7,
            'unit_weight' => 94,
            'unit_volume' => 1,
            'rot_rate' => 100,
            'efficiency' => 1,
            'name' => 'soil',
            'description' => 'brown earth',
        ]);

		Item::create([
            'item_type' => 'mineral',
            'type_id' => 8,
            'unit_weight' => 133,
            'unit_volume' => 1,
            'rot_rate' => 133,
            'efficiency' => 1,
            'name' => 'salt',
            'description' => 'white grains',
        ]);

		Item::create([
            'item_type' => 'mineral',
            'type_id' => 9,
            'unit_weight' => 62,
            'unit_volume' => 1,
            'rot_rate' => 100,
            'efficiency' => 1,
            'name' => 'fresh water',
            'description' => 'water',
        ]);

		Item::create([
			'item_type' => 'mineral',
            'type_id' => 10,
            'unit_weight' => 64,
            'unit_volume' => 1,
            'rot_rate' => 100,
            'efficiency' => 1,
            'name' => 'salt water',
            'description' => 'salty water',
        ]);
    }
}
