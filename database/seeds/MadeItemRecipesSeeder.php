<?php

use Illuminate\Database\Seeder;

use App\MadeItemRecipe;

class MadeItemRecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MadeItemRecipe::truncate();

        MadeItemRecipe::create([
            'id' => 1,
            'made_item_id' => 1, //shovel
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 2,
            'made_item_id' => 2, //Sickle
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 3,
            'made_item_id' => 3, //Hoe
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 4,
            'made_item_id' => 4, //Hand plough
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 5,
            'made_item_id' => 5, //Axe
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 6,
            'made_item_id' => 6, //Harpoon
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 7,
            'made_item_id' => 7, //Spear
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 8,
            'made_item_id' => 8, //Fishing net
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 9,
            'made_item_id' => 9, //Bow
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 10,
            'made_item_id' => 10, //Potter\'s wheel
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 11,
            'made_item_id' => 11, //Clay Pot
            'base_volume' => 10,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 12,
            'made_item_id' => 12, //Box
            'base_volume' => 10,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 13,
            'made_item_id' => 13, //Bag
            'base_volume' => 5,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 14,
            'made_item_id' => 14, //Barrel
            'base_volume' => 10,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 15,
            'made_item_id' => 15, //Clay vase
            'base_volume' => 7,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 16,
            'made_item_id' => 16, //Basket
            'base_volume' => 5,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 17,
            'made_item_id' => 17, //Wheelbarrow
            'base_volume' => 10,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 18,
            'made_item_id' => 18, //Cart
            'base_volume' => 40,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 19,
            'made_item_id' => 19, //Shield
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 20,
            'made_item_id' => 20, //Pick axe
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 21,
            'made_item_id' => 21, //Building
            'base_volume' => 1000,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 22,
            'made_item_id' => 22, //Lock
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 23,
            'made_item_id' => 23, //Ditch
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 24,
            'made_item_id' => 24, //Earthen Wall
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 25,
            'made_item_id' => 25, //Spindle
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 26,
            'made_item_id' => 26, //Clay tablet
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);

        MadeItemRecipe::create([
            'id' => 27,
            'made_item_id' => 27, //String
            'base_volume' => 1,
            'base_rot_rate' => 1,
            'base_efficiency' => 1,
            'skill_cost' => 1,
        ]);
    }
}
