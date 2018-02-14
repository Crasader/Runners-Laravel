<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateArtistRunTable
 * 
 * @author Bastien Nicoud
 */
class CreateArtistRunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_run', function (Blueprint $table) {
            $table->integer('artist_id')->unsigned();
            $table->integer('run_id')->unsigned();

            // Foreing keys
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->foreign('run_id')->references('id')->on('runs');
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
        Schema::table('artist_run', function (Blueprint $table) {
            $table->dropForeign(['artist_id', 'run_id']);
        });

        // Drop the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('artist_run');
        Schema::enableForeignKeyConstraints();
    }
}
