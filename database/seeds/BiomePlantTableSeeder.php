<?php

use Illuminate\Database\Seeder;
use App\Biome;
use App\Plant;

class BiomePlantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$biomes = Biome
        //for each biome, find out which plants can be contained in them, and then that's an entry!
    }
}
