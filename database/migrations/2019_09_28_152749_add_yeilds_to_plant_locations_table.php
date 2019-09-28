<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYeildsToPlantLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_plant', function (Blueprint $table) {
            $table->float('gathered_this_year', 6, 2)->nullable();
            $table->float('todays_remaining_yield', 6, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_plant', function (Blueprint $table) {
            $table->dropColumn('gathered_this_year');
            $table->dropColumn('todays_remaining_yield');
        });
    }
}
