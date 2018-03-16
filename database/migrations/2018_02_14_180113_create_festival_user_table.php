<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateFestivalUserTable
 * 
 * @author Bastien Nicoud
 */
class CreateFestivalUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festival_user', function (Blueprint $table) {
            $table->integer('festival_id')->unsigned();
            $table->integer('user_id')->unsigned();

            // Foreing keys
            $table->foreign('festival_id')->references('id')->on('festivals');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('festival_user', function (Blueprint $table) {
            $table->dropForeign(['festival_id', 'user_id']);
        });

        // Drop the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('festival_user');
        Schema::enableForeignKeyConstraints();
    }
}
