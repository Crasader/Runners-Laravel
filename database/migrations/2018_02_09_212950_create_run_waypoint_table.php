<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('run_waypoint');
        Schema::enableForeignKeyConstraints();
    }
}
