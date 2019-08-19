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


    // categories:
    // agriculture, wood, hunting, pottery, storage, transport, armour, mining, structures, textiles, writing

    public function run()
    {
        MadeItem::truncate();

        MadeItem::create([
            'id' => 1,
            'name' => 'Shovel',
            'category' => 'agriculture'
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
            'category' => 'agriculture'
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
            'category' => 'agriculture'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 3,
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
            'category' => 'agriculture'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 4,
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
            'category' => 'wood'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 5,
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
            'category' => 'hunting'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 6,
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
            'category' => 'hunting'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 7,
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
            'category' => 'hunting'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 8,
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
            'category' => 'hunting'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 9,
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
            'category' => 'pottery'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 10,
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
            'category' => 'storage'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 11,
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
            'category' => 'storage'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 12,
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
            'category' => 'storage'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 13,
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
            'category' => 'storage'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 14,
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
            'category' => 'storage'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 15,
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
            'category' => 'storage'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 16,
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
            'category' => 'transport'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 17,
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
            'category' => 'transport'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 18,
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
            'category' => 'armour'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 19,
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
            'category' => 'mining'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 20,
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
            'category' => 'structures'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 21,
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
            'category' => 'structures'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 22,
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
            'category' => 'structures'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 23,
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
            'category' => 'structures'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 24,
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
            'category' => 'textiles'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 25,
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
            'category' => 'writing'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 26,
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
            'category' => 'textiles'
        ]);

        Item::create([
            'item_type' => 'made_item',
            'type_id' => 27,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'String',
            'description' => ''
        ]);
    }
}
