<?php

use Illuminate\Database\Seeder;

class AnimalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Animal::truncate();

        //so we need to create the animals in biomes, a bit like the plants

        //the difference is, the animals may occur in different biomes at different times of the year

        //it is based on the seasons of food

        //which i have not yet established.

        //i think it's fairly important to get migration and seasonal food working for the mvp

        //so i may as well do that now!

        //including re-seeding the plants!!
    }
}
