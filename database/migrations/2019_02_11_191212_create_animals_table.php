<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('maxSize');
            $table->string('sizeString');
            $table->integer('growthRate');
            $table->boolean('hasHorn');
            $table->boolean('hasFur');
            $table->boolean('hasHide');
            $table->boolean('hasFeathers');
            $table->boolean('isPoisonous');
            $table->boolean('isMeatEater');
            $table->boolean('isPlantEater');
            $table->boolean('isScavenger');
            $table->boolean('isHumanEater');
            $table->integer('fearOfHumans');
            $table->boolean('isPest');
            $table->integer('maxHerdSize');
            $table->integer('maxSpeed');
            $table->integer('fleeDistance');
            $table->boolean('canHide');
            $table->boolean('hasHole');
            $table->boolean('isNocturnal');
            $table->boolean('isBeastOfBurden');
            $table->boolean('isDomesticatable');
            $table->integer('temperatureMin');
            $table->integer('temperatureMax');
            $table->integer('rainfallMin');
            $table->integer('rainfallMax');
            $table->string('furAppearance')->nullable();
            $table->string('legAppearance')->nullable();
            $table->string('feathersAppearance')->nullable();
            $table->string('scalesAppearance')->nullable();
            $table->string('postureAppearance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
