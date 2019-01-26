<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMadeItemRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('made_item_recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            // weight is calculated the same every time.
            $table->integer('base_volume'); // size, but also capacity!
            $table->integer('base_rot_rate');
            $table->integer('base_efficiency'); // strength
            $table->integer('skill_cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('made_item_recipes');
    }
}
