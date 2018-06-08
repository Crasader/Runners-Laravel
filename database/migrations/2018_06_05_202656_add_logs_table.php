<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * AddLogsTable
 *
 * @author Bastien Nicoud
 */
class AddLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loggable_id')->unsigned()->nullable();
            $table->string('loggable_type')->nullable();
            $table->string('action');
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
        // Drop the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('logs');
        Schema::enableForeignKeyConstraints();
    }
}
