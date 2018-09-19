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
            $table->date('birthday');
            $table->text('gender');
            $table->integer('height');
            $table->integer('weight');
            $table->integer('strength');
            $table->text('cheek_type');
            $table->text('jaw_type');
            $table->text('skin_colour');
            $table->text('skin_type');
            $table->text('skin_hairiness');
            $table->text('hair_colour');
            $table->text('hair_type');
            $table->text('nose');
            $table->text('mouth');
            $table->text('eye_type');
            $table->text('eye_colour');
            $table->text('eyebrow_type');

            $table->text('enjoys');
            $table->text('believes');
            $table->text('aLargeGroup');
            $table->text('aSeriousConversation');

            $table->text('born');
            $table->text('fatherWas');
            $table->text('motherWas');
            $table->text('notableParentWas');
            $table->text('notableParent');
            $table->text('graduated');
            $table->text('teachersReportsSay');
            $table->text('furtherEductation');
            $table->text('citation');
            $table->text('commendation');
            $table->text('wasSoBoredThey');

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
