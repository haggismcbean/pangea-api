<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Let's clear the location table first
        // NOTE TO SELF - Maybe I shouldn't do this??
        Item::truncate();

        // TODO - seed this table!

    }
}
