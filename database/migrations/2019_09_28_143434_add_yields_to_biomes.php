<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYieldsToBiomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('biomes', function (Blueprint $table) {
            $table->float('averageHunterGathererYield', 6, 2)->nullable();
            $table->float('averagePastoralYield', 6, 2)->nullable();
            $table->float('averageArableYield', 6, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biomes', function (Blueprint $table) {
            $table->dropColumn('averageHunterGathererYield');
            $table->dropColumn('averagePastoralYield');
            $table->dropColumn('averageArableYield');
        });
    }
}
