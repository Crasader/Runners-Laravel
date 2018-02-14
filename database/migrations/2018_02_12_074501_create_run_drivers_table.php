<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateRunDriversTable
 * 
 * @author Bastien Nicoud
 */
class CreateRunDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('run_drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('run_id')->unsigned();
            $table->integer('car_id')->unsigned();
            $table->integer('car_type_id')->unsigned();
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();

            // Foreing keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('run_id')->references('id')->on('runs');
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('car_type_id')->references('id')->on('car_types');
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
        Schema::table('run_drivers', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'run_id', 'car_id', 'car_type_id']);
        });

        // Drop the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('run_drivers');
        Schema::enableForeignKeyConstraints();
    }
}
