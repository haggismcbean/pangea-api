<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('item_type');
            $table->integer('type_id')->unsigned();
            $table->integer('unit_weight'); //weight
            $table->integer('unit_volume'); //size
            $table->integer('rot_rate'); //durability
            $table->string('name');
            $table->string('description');
            // 'efficiency' // strength
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
