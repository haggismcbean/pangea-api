<?php

use Illuminate\Database\Seeder;
use App\Location;

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

        DB::table('locations')->insert([
            'x_coord' => 0,
            'y_coord' => 0,
            'z_coord' => 0,
        ]);
    }
}
