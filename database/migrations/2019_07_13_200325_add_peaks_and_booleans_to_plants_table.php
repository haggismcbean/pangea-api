<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPeaksAndBooleansToPlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->integer('rootsSize');
            $table->string('rootsAppearance');
            $table->string('rootsColor');
            $table->string('rootsShape');

            $table->integer('fruitSize');
            $table->string('fruitAppearance');
            $table->string('fruitColor');
            $table->string('fruitShape');

            $table->integer('peakFlowerDay');
            $table->integer('troughFlowerDay');

            $table->integer('peakFruitDay');
            $table->integer('troughFruitDay');

            $table->integer('peakLeavesDay');
            $table->integer('troughLeavesDay');

            $table->integer('peakSeedDay');
            $table->integer('troughSeedDay');

            $table->integer('poisonStrength'); // number between 0 and 10
            $table->integer('foodStrength'); // number between 0 and 10

            $table->boolean('isEatenRaw');
            $table->boolean('isEatenCooked');

            // possible uses: 
            // fabric, paper, fuel, food, storage
            $table->string('flowerUse');
            $table->string('seedUse');
            $table->string('stalkUse');
            $table->string('fruitUse');
            $table->string('leafUse');
            $table->string('rootUse');

            $table->integer('flowerProcessTime'); // so eg flak becomes processed flak which we can use to create clothes :)
            $table->integer('seedProcessTime');
            $table->integer('stalkProcessTime');
            $table->integer('fruitProcessTime');
            $table->integer('leafProcessTime');
            $table->string('rootProcessTime');

            $table->dropColumn('isPoisonous');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plants', function (Blueprint $table) {
            //
        });
    }
}
