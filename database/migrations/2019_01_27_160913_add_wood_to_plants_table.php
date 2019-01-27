<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWoodToPlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->boolean('hasWood');
            $table->text('woodAppearance')->nullable();
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
            $table->dropColumn('woodAppearance');
            $table->dropColumn('hasWood');
        });
    }
}
