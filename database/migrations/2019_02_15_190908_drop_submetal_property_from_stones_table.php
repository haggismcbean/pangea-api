<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropSubmetalPropertyFromStonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stones', function (Blueprint $table) {
            $table->dropColumn('sub_metal_id');
            $table->dropColumn('sub_metal_yield');
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
