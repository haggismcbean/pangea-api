<?php

use Illuminate\Database\Seeder;

use App\AnimalProduct;
use App\Item;

class AnimalProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AnimalProduct::truncate();

        AnimalProduct::create([
            'id' => 1,
            'name' => 'meat',
            'description' => '',
            'animal_id' => 0,
            'is_poisonous' => false
        ]);

        Item::create([
            'item_type' => 'animal_product',
            'type_id' => 1,
            'unit_weight' => 15,
            'unit_volume' => 1,
            'rot_rate' => 1,
            'efficiency' => 1,
            'name' => 'meat',
            'description' => ''
        ]);

        AnimalProduct::create([
            'id' => 2,
            'name' => 'bone',
            'description' => '',
            'animal_id' => 0,
            'is_poisonous' => false
        ]);

        Item::create([
            'item_type' => 'animal_product',
            'type_id' => 2,
            'unit_weight' => 1,
            'unit_volume' => 1,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'bone',
            'description' => ''
        ]);

        AnimalProduct::create([
            'id' => 3,
            'name' => 'horn',
            'description' => '',
            'animal_id' => 0,
            'is_poisonous' => false
        ]);

        Item::create([
            'item_type' => 'animal_product',
            'type_id' => 3,
            'unit_weight' => 10,
            'unit_volume' => 1,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'horn',
            'description' => ''
        ]);

        AnimalProduct::create([
            'id' => 4,
            'name' => 'hide',
            'description' => '',
            'animal_id' => 0,
            'is_poisonous' => false
        ]);

        Item::create([
            'item_type' => 'animal_product',
            'type_id' => 4,
            'unit_weight' => 50,
            'unit_volume' => 1,
            'rot_rate' => 2,
            'efficiency' => 4,
            'name' => 'hide',
            'description' => ''
        ]);

        AnimalProduct::create([
            'id' => 5,
            'name' => 'feathers',
            'description' => '',
            'animal_id' => 0,
            'is_poisonous' => false
        ]);

        Item::create([
            'item_type' => 'animal_product',
            'type_id' => 5,
            'unit_weight' => 1,
            'unit_volume' => 1,
            'rot_rate' => 45,
            'efficiency' => 4,
            'name' => 'feathers',
            'description' => ''
        ]);
    }
}