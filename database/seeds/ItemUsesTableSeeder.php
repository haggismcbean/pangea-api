<?php

use Illuminate\Database\Seeder;
use App\ItemUse;

class ItemUsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemUse::truncate();

        ItemUse::create([
        	'id' => 1,
        	'activity' => 'lumberjacking',
        	'item_id' => 5 //axe
        ]);

        ItemUse::create([
        	'id' => 2,
        	'activity' => 'fighting',
        	'item_id' => 5 //axe
        ]);

        ItemUse::create([
        	'id' => 3,
        	'activity' => 'fishing',
        	'item_id' => 6 //harpoon
        ]);

        ItemUse::create([
        	'id' => 4,
        	'activity' => 'hunting',
        	'item_id' => 7 //spear
        ]);

        ItemUse::create([
        	'id' => 5,
        	'activity' => 'fighting',
        	'item_id' => 7 //spear
        ]);

        ItemUse::create([
        	'id' => 6,
        	'activity' => 'fishing',
        	'item_id' => 8 //net
        ]);

        ItemUse::create([
        	'id' => 7,
        	'activity' => 'hunting',
        	'item_id' => 9 //bow
        ]);
    }
}
