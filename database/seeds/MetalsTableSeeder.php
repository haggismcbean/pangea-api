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
        ], [
            'id' => 1,
            'name' => 'silver',
            'description' => 'shiny silver metal',
        ], [
            'id' => 1,
            'name' => 'copper',
            'description' => 'burnished metal',
        ], [
            'id' => 1,
            'name' => 'tin',
            'description' => 'pale silver metal',
        ], [
            'id' => 1,
            'name' => 'bronze',
            'description' => 'red metal',
        ], [
            'id' => 1,
            'name' => 'iron',
            'description' => 'cold grey metal',
        ], [
            'id' => 1,
            'name' => 'steel',
            'description' => 'shiny grey metal',
        ], [
            'id' => 1,
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
        ], [
        	'item_type' => 'metal',
        	'type_id' => 2,
        	'unit_weight' => 650,
        	'unit_volume' => 10,
        	'rot_rate' => 100,
        	'efficiency' => 8,
            'name' => 'silver',
            'description' => 'shiny silver metal',
        ], [
        	'item_type' => 'metal',
        	'type_id' => 3,
        	'unit_weight' => 550,
        	'unit_volume' => 100,
        	'rot_rate' => 20,
        	'efficiency' => 25,
            'name' => 'copper',
            'description' => 'burnished metal',
        ], [
        	'item_type' => 'metal',
        	'type_id' => 4,
        	'unit_weight' => 550,
        	'unit_volume' => 100,
        	'rot_rate' => 20,
        	'efficiency' => 8,
            'name' => 'tin',
            'description' => 'pale silver metal',
        ], [
        	'item_type' => 'metal',
        	'type_id' => 5,
        	'unit_weight' => 510,
        	'unit_volume' => 70,
        	'rot_rate' => 60,
        	'efficiency' => 80,
            'name' => 'bronze',
            'description' => 'red metal',
        ], [
        	'item_type' => 'metal',
        	'type_id' => 6,
        	'unit_weight' => 450,
        	'unit_volume' => 70,
        	'rot_rate' => 100,
        	'efficiency' => 150,
            'name' => 'iron',
            'description' => 'cold grey metal',
        ], [
        	'item_type' => 'metal',
        	'type_id' => 7,
        	'unit_weight' => 490,
        	'unit_volume' => 70,
        	'rot_rate' => 100,
        	'efficiency' => 180,
            'name' => 'steel',
            'description' => 'shiny grey metal',
        ], [
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
