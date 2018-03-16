<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateRunWaypointTable
 * 
 * @author Bastien Nicoud
 */
class CreateRunWaypointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('run_waypoint', function (Blueprint $table) {
            $table->integer('run_id')->unsigned();
            $table->integer('waypoint_id')->unsigned();
            $table->integer('order')->unsigned();

            // Foreing keys
            $table->foreign('run_id')->references('id')->on('runs');
            $table->foreign('waypoint_id')->references('id')->on('waypoints');
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
        Schema::table('run_waypoint', function (Blueprint $table) {
            $table->dropForeign(['run_id', 'waypoint_id']);
        });

        // Drop the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('run_waypoint');
        Schema::enableForeignKeyConstraints();
    }
}
