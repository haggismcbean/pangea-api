<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zone_id');
            $table->timestamps();
            $table->integer('current_yield');
            $table->dateTime('was_planted_at')->nullable();
            $table->integer('plant_id')->nullable();
            $table->dateTime('was_cleared_at')->nullable();
            $table->integer('cleared_score')->nullable();
            $table->dateTime('was_fertilized_at')->nullable();
            $table->integer('fertilized_score')->nullable();
            $table->dateTime('was_tilled_at')->nullable();
            $table->integer('tilled_score')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farms');
    }
}
