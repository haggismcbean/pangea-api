<?php

use Illuminate\Database\Seeder;

use App\MadeItem;
use App\Item;

class MadeItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MadeItem::truncate();

        MadeItem::create([
            'id' => 1,
            'name' => 'Shovel',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 1,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'shovel',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 2,
            'name' => 'Sickle',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'sickle',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 3,
            'name' => 'Hoe',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'hoe',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 4,
            'name' => 'Hand plough',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Hand plough',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 5,
            'name' => 'Axe',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Axe',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 6,
            'name' => 'Harpoon',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Harpoon',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 7,
            'name' => 'Spear',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Spear',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 8,
            'name' => 'Fishing net',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Fishing net',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 9,
            'name' => 'Bow',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Bow',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 10,
            'name' => 'Potter\'s wheel',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Potter\'s wheel',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 11,
            'name' => 'Clay Pot',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Clay Pot',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 12,
            'name' => 'Box',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Box',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 13,
            'name' => 'Bag',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Bag',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 14,
            'name' => 'Barrel',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Barrel',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 15,
            'name' => 'Clay vase',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Clay vase',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 16,
            'name' => 'Basket',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Basket',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 17,
            'name' => 'Wheelbarrow',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Wheelbarrow',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 18,
            'name' => 'Cart',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Cart',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 19,
            'name' => 'Shield',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Shield',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 20,
            'name' => 'Pick axe',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Pick axe',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 21,
            'name' => 'Building',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Building',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 22,
            'name' => 'Lock',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Lock',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 23,
            'name' => 'Ditch',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Ditch',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 24,
            'name' => 'Earthen Wall',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Earthen Wall',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 25,
            'name' => 'Spindle',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Spindle',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 26,
            'name' => 'Clay tablet',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'Clay tablet',
            'description' => ''
        ]);

        MadeItem::create([
            'id' => 27,
            'name' => 'String',
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'String',
            'description' => ''
        ]);
    }
}
