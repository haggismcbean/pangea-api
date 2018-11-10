<?php

use Illuminate\Database\Seeder;
use App\Zone;
use App\Location;

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
        Zone::truncate();

        $locations = Location::get();

        foreach ($locations as $location) {
            if ($location->biome !== 'Ocean') {

                DB::table('zones')->insert([
                    'location_id' => $location->id,
                    'name' => 'Campsite',
                    'size' => 1,
                ]);

                DB::table('zones')->insert([
                    'location_id' => $location->id,
                    'name' => 'Wilderness',
                    'size' => 99,
                ]);
            }
        }
    }
}
