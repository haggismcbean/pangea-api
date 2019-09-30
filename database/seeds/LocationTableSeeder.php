<?php

use Illuminate\Database\Seeder;
use App\Location;
use App\Biome;
use App\Plant;
use App\WorldGenerator\World;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the location table first
        Location::truncate();

        $world = new World();

        foreach ($world->pixels as $location) {
//            $biome = Biome::where('temperature', $location->temperature)->where('rainfall', $location->rainfall)->where('name', '!=', 'Ocean')->first();
            DB::table('locations')->insert([
                'x_coord' => $location->x,
                'y_coord' => $location->y,
                'z_coord' => $location->height,
                'color' => $location->color,
                'biome' => $location->biome,
                'rainfall' => $location->rainfall,
                'temperature' => $location->temperature,
        		'current_temperature' => $location->temperature,
        		'current_rainfall' => $location->rainfall,
                'has_river' => $location->hasRiver,
                'biome_id' => 0,
                'animals_gathered_today' => 0,
                'peak_animal_day' => 25,
                'trough_animal_day' => 5
            ]);
        }
    }
}
