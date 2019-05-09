<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // okay so how it happens:
        // a mine, when created, will have different stones and minerals added to it
        // you find these and can choose which ones to gather - you wont find all in every mine

        // stones and minerals are seeded on LOCATION

        // when the mine is created which things you will find are added to the mine

        // locationItems table with stones and minerals listed
        // mineItems table mine_id item_type item_id

        Schema::create('mines', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('zone_id');
            $table->string('layer');
            $table->integer('integrity'); // starts at 100, drops when you dig, but increases if you reinforce it
                                          // however you can't just reinforce ad nauseum. you can't reinforce above 100
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mines');
    }
}
