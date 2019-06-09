<?php

use Illuminate\Database\Seeder;

use App\ItemTrait;

class ItemTraitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ItemTrait::truncate();
        // App\Item::truncate();

        ItemTrait::create([
        	'id' => 1,
        	'trait' => 'wicker'
        ]);

        ItemTrait::create([
        	'id' => 2,
        	'trait' => 'fodder'
        ]);

        ItemTrait::create([
        	'id' => 3,
        	'trait' => 'fruit'
        ]);

        ItemTrait::create([
        	'id' => 4,
        	'trait' => 'vegetable'
        ]);

        ItemTrait::create([
        	'id' => 5,
        	'trait' => 'grain'
        ]);

        ItemTrait::create([
        	'id' => 6,
        	'trait' => 'fermentable'
        ]);

        ItemTrait::create([
        	'id' => 7,
        	'trait' => 'pourous'
        ]);

        ItemTrait::create([
        	'id' => 8,
        	'trait' => 'hard'
        ]);

        ItemTrait::create([
        	'id' => 9,
        	'trait' => 'brittle'
        ]);

        ItemTrait::create([
        	'id' => 10,
        	'trait' => 'soft'
        ]);

        ItemTrait::create([
        	'id' => 11,
        	'trait' => 'crumbly'
        ]);

        ItemTrait::create([
            'id' => 12,
            'trait' => 'fibrous'
        ]);
    }
}
