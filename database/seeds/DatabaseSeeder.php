<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(CharacterTableSeeder::class);
        // $this->call(MessagesTableSeeder::class);
        // $this->call(PlantsTableSeeder::class);
        // $this->call(BiomeTableSeeder::class);
        // $this->call(LocationTableSeeder::class); //Warning - this takes a minute or so to run
        // $this->call(BiomePlantTableSeeder::class);
        // $this->call(LocationPlantTableSeeder::class); //Warning - this takes a couple of minutes
        // $this->call(ZonesTableSeeder::class); //Warning - this takes a minute or so
        // $this->call(TasksTableSeeder::class);
        // $this->call(MetalsTableSeeder::class);
        // $this->call(MineralsTableSeeder::class);
        // $this->call(AnimalsTableSeeder::class);
        // $this->call(StonesTableSeeder::class);
        

        // $this->call(MadeItemsTableSeeder::class);
        // $this->call(MadeItemRecipesSeeder::class);
        // $this->call(RecipeIngredientsSeeder::class);

        // $this->call(AnimalProductsTableSeeder::class);

        $this->call(ItemUsesTableSeeder::class);

    }
}
