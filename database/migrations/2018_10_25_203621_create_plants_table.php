<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('location_id')->unsigned();
            $table->integer('biome_id')->unsigned();
            $table->string('typeName');
            $table->integer('maxHeight');
            $table->integer('growthRate');
            $table->boolean('isSeasonal');
            $table->boolean('hasFruit');
            $table->boolean('isPoisonous');
            $table->boolean('hasFlower');
            $table->integer('rainfallMin');
            $table->integer('rainfallMax');
            $table->integer('temperatureMin');
            $table->integer('temperatureMax');
            $table->integer('rotRate');
            $table->string('seedAppearance')->nullable();
            $table->string('seedSize')->nullable();
            $table->string('seedColor')->nullable();
            $table->string('seedShape')->nullable();
            $table->string('seedPattern')->nullable();
            $table->string('flowerAppearance')->nullable();
            $table->string('flowerSize')->nullable();
            $table->string('flowerColor')->nullable();
            $table->string('flowerShape')->nullable();
            $table->string('leafAppearance')->nullable();
            $table->string('leafSize')->nullable();
            $table->string('leafColor')->nullable();
            $table->string('leafShape')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plants');
    }
}
