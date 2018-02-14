<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateCarsTable
 * 
 * @author Bastien Nicoud
 */
class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plate_number');
            $table->string('brand');
            $table->string('model');
            $table->string('color');
            $table->string('status');
            $table->integer('type_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Foreing keys
            $table->foreign('type_id')->references('id')->on('car_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the foreign keys
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['car_type_id']);
        });

        // Drop the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('cars');
        Schema::enableForeignKeyConstraints();
    }
}
