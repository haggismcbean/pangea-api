<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOwnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_owner', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('ownerId')->unsigned();
            $table->string('ownerType');
            $table->integer('itemId')->unsigned();
            $table->integer('count');
            $table->integer('age');
            $table->integer('quality');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_owner');
    }
}
