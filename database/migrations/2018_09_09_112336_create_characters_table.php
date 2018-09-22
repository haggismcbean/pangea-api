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
            $table->text('name');
            $table->text('forename');
            $table->text('surname');
            $table->text('pronoun');
            $table->text('posessivePronoun');
            $table->date('birthday');
            $table->text('gender');
            $table->integer('height');
            $table->integer('weight');
            $table->integer('strength');
            $table->text('appearance');
            $table->text('personality');
            $table->text('backstory');

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
