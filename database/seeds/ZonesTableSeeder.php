<?php

use Illuminate\Database\Seeder;
use App\Zone;
use App\Location;
use App\WorldGenerator\BiomeDescriptionGenerator;

class ZonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Let's clear the location table first
        // Zone::truncate();

        // $locations = Location::get();

        // foreach ($locations as $location) {
        //     if ($location->biome !== 'Ocean') {

        //         DB::table('zones')->insert([
        //             'location_id' => $location->id,
        //             'name' => 'Wilderness',
        //             'size' => 100,
        //             'description' => BiomeDescriptionGenerator::getDescription($location->biome)
        //         ]);
        //     }
        // }


        // TO JUST UPDATE DESCRIPTIONS: 

        $zones = Zone::where('name', 'Wilderness')->get();

        foreach($zones as $zone) {
            $zone->description = BiomeDescriptionGenerator::getDescription($zone->location()->first()->biome);
            $zone->save();
        }
    }
}
