<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_outputs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('task_id');
            $table->integer('item_id')->nullable(); //can be null. eg for fighting or travelling tasks.
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
        Schema::dropIfExists('task_outputs');
    }
}
