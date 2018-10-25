<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biomes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('rainfall');
            $table->integer('temperature');

            $table->integer('sproutRainfall');
            $table->integer('sproutTemperature');

            $table->integer('deathRainfall');
            $table->integer('deathTemperature');

            $table->integer('plantDensity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biomes');
    }
}
