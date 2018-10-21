<?php

use Illuminate\Database\Seeder;
use App\Location;
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
        //Let's clear the location table first
        Location::truncate();

        $world = new World();

        foreach ($world->pixels as $location) {
            DB::table('locations')->insert([
                'x_coord' => $location->x,
                'y_coord' => $location->y,
                'z_coord' => $location->height,
                'color' => $location->color,
                'biome' => $location->biome,
                'rainfall' => $location->rainfall,
                'temperature' => $location->temperature,
                'has_river' => $location->hasRiver,
            ]);
        }

    }
}
