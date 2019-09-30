<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGatheredCountsToLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->float('animals_gathered_today', 6, 2);

            $table->dropColumn('gathered_this_year');
            $table->dropColumn('todays_remaining_animal_yield');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location', function (Blueprint $table) {
            $table->dropColumn('animals_gathered_today');

            $table->float('gathered_this_year', 6, 2)->nullable();
            $table->float('todays_remaining_animal_yield', 6, 2)->nullable();
        });
    }
}
