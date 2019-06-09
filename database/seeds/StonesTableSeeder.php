<?php

use Illuminate\Database\Seeder;

use App\Stone;
use App\Item;
use App\ItemItemTrait;

class StonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stone::truncate();

        Stone::create([
            'id' => 1,
            'description' => 'chalk',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => true,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 1,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'chalk',
            'description' => 'white chalky stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 11 //crumbly
        ]);

        Stone::create([
            'id' => 2,
            'description' => 'chert',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 2,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'chert',
            'description' => 'brown stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 9 //hard
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 11 //crumbly
        ]);

        Stone::create([
            'id' => 3,
            'description' => 'conglomerate',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 3,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'conglomerate',
            'description' => 'grey stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 4,
            'description' => 'dolomite',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => true,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 4,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'dolomite',
            'description' => 'white stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 9 //brittle
        ]);

        Stone::create([
            'id' => 5,
            'description' => 'limestone',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => true,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 5,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'limestone',
            'description' => 'pale yellow stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 7 //pourous
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        Stone::create([
            'id' => 6,
            'description' => 'mudstone',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 6,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'mudstone',
            'description' => 'pale brown stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 7 //pourous
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 7,
            'description' => 'rock salt',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 7,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'rock salt',
            'description' => 'white stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 11 //crumbly
        ]);

        Stone::create([
            'id' => 8,
            'description' => 'sandstone',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 8,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'sandstone',
            'description' => 'pale yellow stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 7 //pourous
        ]);

        Stone::create([
            'id' => 9,
            'description' => 'claystone',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 9,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'claystone',
            'description' => 'white stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 11 //crumbly
        ]);

        Stone::create([
            'id' => 10,
            'description' => 'shale',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 10,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'shale',
            'description' => 'dark grey stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 9 //brittle
        ]);

        Stone::create([
            'id' => 11,
            'description' => 'siltstone',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 11,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'siltstone',
            'description' => 'pale yellow stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 9 //brittle
        ]);

        Stone::create([
            'id' => 12,
            'description' => 'andesite',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'igneous extrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 12,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'andesite',
            'description' => 'black stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 11 //crumbly
        ]);

        Stone::create([
            'id' => 13,
            'description' => 'basalt',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'igneous extrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 13,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'basalt',
            'description' => 'black stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 14,
            'description' => 'dacite',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'igneous extrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 14,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'dacite',
            'description' => 'black stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 15,
            'description' => 'obsidian',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'igneous extrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 15,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'obsidian',
            'description' => 'shiny black stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 11 //crumbly
        ]);

        Stone::create([
            'id' => 16,
            'description' => 'rhyolite',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'igneous extrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 16,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'rhyolite',
            'description' => 'dark grey stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 11 //crumbly
        ]);

        Stone::create([
            'id' => 17,
            'description' => 'gneiss',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'metamorphic',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 17,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'gneiss',
            'description' => 'pale grey stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 18,
            'description' => 'marble',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'metamorphic',
            'is_flux' => true,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 18,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'marble',
            'description' => 'white marbled stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 19,
            'description' => 'phylite',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'metamorphic',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 19,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'phylite',
            'description' => 'black stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 20,
            'description' => 'quartzite',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'metamorphic',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 20,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'quartzite',
            'description' => 'green marbled stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 21,
            'description' => 'schist',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'metamorphic',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 21,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'schist',
            'description' => 'brown stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 22,
            'description' => 'slate',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'metamorphic',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 22,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'slate',
            'description' => 'grey layered stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 9 //brittle
        ]);

        Stone::create([
            'id' => 23,
            'description' => 'diorite',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'igneous intrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 23,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'diorite',
            'description' => 'grey stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 24,
            'description' => 'gabbro',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'igneous intrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 24,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'gabbro',
            'description' => 'dark grey stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 7 //pourous
        ]);

        Stone::create([
            'id' => 25,
            'description' => 'granite',
            'metal_id' => null,
            'rarity' => 2000,
            'metal_yield' => 1,
            'layer' => 'igneous intrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 25,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'granite',
            'description' => 'pale brown stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 26,
            'description' => 'cassiterite',
            'metal_id' => 4, //tin
            'rarity' => 16,
            'metal_yield' => 5,
            'layer' => 'igneous intrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 26,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'cassiterite',
            'description' => 'pale brown stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 27,
            'description' => 'copper',
            'metal_id' => 3, //copper
            'rarity' => 30,
            'metal_yield' => 10,
            'layer' => 'igneous extrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 27,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'copper',
            'description' => 'burnished red metal',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 28,
            'description' => 'galena',
            'metal_id' => 8, //lead
            'rarity' => 60,
            'metal_yield' => 3,
            'layer' => 'igneous extrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 28,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'galena',
            'description' => 'dark grey stone with metalic sheen',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8 //hard
        ]);

        Stone::create([
            'id' => 29,
            'description' => 'gold',
            'metal_id' => 1, //gold
            'rarity' => 1,
            'metal_yield' => 10,
            'layer' => 'igneous extrusive',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 29,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'gold',
            'description' => 'bright yellow metal',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        Stone::create([
            'id' => 30,
            'description' => 'hematite',
            'metal_id' => 6, //iron
            'rarity' => 100,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 30,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'hematite',
            'description' => 'red stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        Stone::create([
            'id' => 31,
            'description' => 'horn silver',
            'metal_id' => 2, //silver
            'rarity' => 7,
            'metal_yield' => 4,
            'layer' => 'metamorphic',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 31,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'horn silver',
            'description' => 'grey stone with shiny veins',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        Stone::create([
            'id' => 32,
            'description' => 'limonite',
            'metal_id' => 6, //iron
            'rarity' => 100,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 32,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'limonite',
            'description' => 'yellow stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        Stone::create([
            'id' => 33,
            'description' => 'magnetite',
            'metal_id' => 6, //iron
            'rarity' => 100,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 33,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'magnetite',
            'description' => 'black shiny stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        Stone::create([
            'id' => 34,
            'description' => 'malachite',
            'metal_id' => 3, //copper
            'rarity' => 45,
            'metal_yield' => 3,
            'layer' => 'metamorphic',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 34,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'malachite',
            'description' => 'green stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        Stone::create([
            'id' => 35,
            'description' => 'silver',
            'metal_id' => 2, //silver
            'rarity' => 3,
            'metal_yield' => 10,
            'layer' => 'metamorphic',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 35,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'silver',
            'description' => 'bright silver metal',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 10 //soft
        ]);

        Stone::create([
            'id' => 36,
            'description' => 'tetrahedrite',
            'metal_id' => 3, //copper
            'rarity' => 50,
            'metal_yield' => 1,
            'layer' => 'sedimentary',
            'is_flux' => false,
        ]);

        $item = Item::create([
            'item_type' => 'stone',
            'type_id' => 36,
            'unit_weight' => 150,
            'unit_volume' => 20,
            'rot_rate' => 100,
            'efficiency' => 10,
            'name' => 'tetrahedrite',
            'description' => 'shiny black stone',
        ]);

        ItemItemTrait::create([
            'item_id' => $item->id,
            'trait_id' => 8  //hard
        ]);
    }
}
