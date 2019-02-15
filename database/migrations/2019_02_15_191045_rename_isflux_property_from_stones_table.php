<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameIsfluxPropertyFromStonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stones', function (Blueprint $table) {
            // $table->dropColumn('isFlux');
            // $table->boolean('is_flux');
            $table->dropColumn('metal_id');
            $table->integer('metal_id')->nullable();
            $table->dropColumn('metal_yield');
            $table->integer('metal_yield')->nullable();
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
