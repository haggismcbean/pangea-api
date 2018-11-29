<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_inputs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('task_id');
            $table->integer('item_id'); //(note that tools are not inputs! only things actually used up are inputs) 
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_inputs');
    }
}
