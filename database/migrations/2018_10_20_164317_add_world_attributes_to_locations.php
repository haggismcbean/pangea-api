<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorldAttributesToLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->text('color');
            $table->text('biome');
            $table->integer('rainfall');
            $table->integer('temperature');
            $table->boolean('has_river');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['color']);
            $table->dropColumn(['biome']);
            $table->dropColumn(['rainfall']);
            $table->dropColumn(['temperature']);
            $table->dropColumn(['has_river']);
        });
    }
}
