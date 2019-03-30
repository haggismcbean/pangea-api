<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuantitiesToActivityItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_items', function (Blueprint $table) {
            $table->integer('quantity_added');
            $table->integer('quantity_required');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_items', function (Blueprint $table) {
            $table->dropColumn('quantity_added');
            $table->dropColumn('quantity_required');
        });
    }
}
