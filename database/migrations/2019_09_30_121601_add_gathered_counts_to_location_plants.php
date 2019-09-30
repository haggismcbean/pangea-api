<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGatheredCountsToLocationPlants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_plant', function (Blueprint $table) {
            $table->float('fruit_gathered_today', 6, 2);
            $table->float('flower_gathered_today', 6, 2);
            $table->float('seed_gathered_today', 6, 2);
            $table->float('leaf_gathered_today', 6, 2);
            $table->float('stalk_gathered_today', 6, 2);
            $table->float('root_gathered_today', 6, 2);

            $table->dropColumn('gathered_this_year');
            $table->dropColumn('todays_remaining_yield');
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
            $table->dropColumn('fruit_gathered_today');
            $table->dropColumn('flower_gathered_today');
            $table->dropColumn('seed_gathered_today');
            $table->dropColumn('leaf_gathered_today');
            $table->dropColumn('stalk_gathered_today');
            $table->dropColumn('root_gathered_today');

            $table->float('gathered_this_year', 6, 2)->nullable();
            $table->float('todays_remaining_yield', 6, 2)->nullable();
        });
    }
}
