<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateFestivalTable
 * 
 * @author Bastien Nicoud
 */
class CreateFestivalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festivals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('edition');
            $table->string('name');
            $table->dateTime('starts_on')->nullable();
            $table->dateTime('ends_on')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('festivals');
        Schema::enableForeignKeyConstraints();
    }
}
