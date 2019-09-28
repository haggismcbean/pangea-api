<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYieldsToPlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->float('yearly_yield', 6, 2)->nullable();
            $table->integer('max_plants_in_farm')->nullable();
            $table->float('yield_per_item', 6, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->dropColumn('yearly_yield');
            $table->dropColumn('max_plants_in_farm');
            $table->dropColumn('yield_per_item');
        });
    }
}
