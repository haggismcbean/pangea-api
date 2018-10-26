<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('locations', function (Blueprint $table) {
        //     $table->integer('biome_id')->unsigned();
        // });

        Schema::table('biomes', function (Blueprint $table) {
            $table->dropColumn('plant_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('biomes', function (Blueprint $table) {
        //     $table->dropColumn('biome_id');
        // });
    }
}
