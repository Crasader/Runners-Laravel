<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * createKielasTable
 *
 * @author Nicolas Henry
 */
class CreateKielaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kielas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();

            // Foreing keys
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
        // Drop the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('kielas');
        Schema::enableForeignKeyConstraints();
    }
}
