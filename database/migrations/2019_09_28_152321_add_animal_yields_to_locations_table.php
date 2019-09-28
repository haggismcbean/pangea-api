<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnimalYieldsToLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->float('yearly_animal_yield', 6, 2)->nullable();
            $table->float('gathered_this_year', 6, 2)->nullable();
            $table->float('todays_remaining_animal_yield', 6, 2)->nullable();
            $table->integer('peak_animal_day')->nullable();
            $table->integer('trough_animal_day')->nullable();
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
            $table->dropColumn('yearly_animal_yield');
            $table->dropColumn('gathered_this_year');
            $table->dropColumn('todays_remaining_animal_yield');
            $table->dropColumn('peak_animal_day');
            $table->dropColumn('trough_animal_day');
        });
    }
}
