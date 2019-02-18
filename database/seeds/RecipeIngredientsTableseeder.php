<?php

use Illuminate\Database\Seeder;

use App\RecipeIngredient;

use App\Item;

class RecipeIngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecipeIngredient::truncate();

        RecipeIngredient::create([
            'recipe_id' => 27, //String
            'quantity_min' => 120,
            'quantity_max' => 140,
            'skill_name' => 'textiles',
			'item_id' => null,
			'item_type' => 'grass'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 1, //shovel
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 1, //shovel
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'stone'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 2, //Sickle
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 2, //Sickle
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'stone'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 3, //Hoe
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'stone'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 3, //Hoe
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 4, //Hand plough
            'quantity_min' => 300,
            'quantity_max' => 340,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 5, //Axe
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 5, //Axe
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'stone'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 6, //Harpoon
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 6, //Harpoon
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'bone'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 7, //Spear
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'stone'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 7, //Spear
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        $stringId = Item::where('name', 'string')->first()->id;

        if (!$stringId) {
        	$stringId = 0;
        }

        RecipeIngredient::create([
            'recipe_id' => 8, //Fishing net
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'textiles',
			'item_id' => $stringId,
			'item_type' => null
        ]);

        RecipeIngredient::create([
            'recipe_id' => 9, //Bow
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'woodwork',
			'item_id' => 1
        ]);

        RecipeIngredient::create([
            'recipe_id' => 9, //Bow
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'textiles',
			'item_id' => $stringId,
			'item_type' => null
        ]);

        RecipeIngredient::create([
            'recipe_id' => 10, //Potter\'s wheel
            'quantity_min' => 80,
            'quantity_max' => 120,
            'skill_name' => 'masonry',
			'item_id' => null,
			'item_type' => 'stone'
        ]);

        $clayId = Item::where('name', 'clay')->first()->id;

        RecipeIngredient::create([
            'recipe_id' => 11, //Clay Pot
            'quantity_min' => 20,
            'quantity_max' => 120,
            'skill_name' => 'pottery',
			'item_id' => $clayId,
			'item_type' => null
        ]);

        RecipeIngredient::create([
            'recipe_id' => 12, //Box
            'quantity_min' => 20,
            'quantity_max' => 240,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 13, //Bag
            'quantity_min' => 5,
            'quantity_max' => 120,
            'skill_name' => 'textiles',
			'item_id' => $stringId,
			'item_type' => null
        ]);

        RecipeIngredient::create([
            'recipe_id' => 14, //Barrel
            'quantity_min' => 10,
            'quantity_max' => 100,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 15, //Clay vase
            'quantity_min' => 70,
            'quantity_max' => 170,
            'skill_name' => 'pottery',
			'item_id' => $clayId,
			'item_type' => null
        ]);

        RecipeIngredient::create([
            'recipe_id' => 16, //Basket
            'quantity_min' => 50,
            'quantity_max' => 100,
            'skill_name' => 'weaving',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 17, //Wheelbarrow
            'quantity_min' => 100,
            'quantity_max' => 140,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 18, //Cart
            'quantity_min' => 400,
            'quantity_max' => 700,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 19, //Shield
            'quantity_min' => 120,
            'quantity_max' => 220,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 20, //Pick axe
            'quantity_min' => 120,
            'quantity_max' => 140,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 21, //Building
            'quantity_min' => 1000,
            'quantity_max' => 1200,
            'skill_name' => 'construction',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 22, //Lock
            'quantity_min' => 120,
            'quantity_max' => 140,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 25, //Spindle
            'quantity_min' => 120,
            'quantity_max' => 140,
            'skill_name' => 'woodwork',
			'item_id' => null,
			'item_type' => 'wood'
        ]);

        RecipeIngredient::create([
            'recipe_id' => 26, //Clay tablet
            'quantity_min' => 120,
            'quantity_max' => 140,
            'skill_name' => 'pottery',
			'item_id' => $clayId,
			'item_type' => null
        ]);
    }
}
