<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropertiesToStonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stones', function (Blueprint $table) {
            $table->integer('rarity');
            $table->text('layer'); //sedimentary, igneous extrusive, metamorphic, igneous intrusive
            $table->boolean('isFlux');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stones', function (Blueprint $table) {
            //
        });
    }
}
