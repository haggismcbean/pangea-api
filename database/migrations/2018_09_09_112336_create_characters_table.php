<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('birthday');
            $table->text('gender');
            $table->integer('height');
            $table->integer('weight');
            $table->integer('strength');
            $table->integer('cheek_type');
            $table->integer('jaw_type');
            $table->integer('skin_colour');
            $table->integer('skin_type');
            $table->integer('skin_hairiness');
            $table->integer('hair_colour');
            $table->integer('hair_type');
            $table->integer('nose');
            $table->integer('mouth');
            $table->integer('eye_type');
            $table->integer('eye_colour');
            $table->integer('eyebrow_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
