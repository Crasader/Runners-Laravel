<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * AddImagesTable
 * 
 * @author Bastien Nicoud
 */
class AddImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('have_image_id')->unsigned();
            $table->string('have_image_type');
            $table->string('type')->nullable(); // To describe the type of image (driver's license, profile picture, ...)
            $table->string('title')->nullable(); // Eventual title for the picture
            $table->string('path');
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
        // Drop the foreign keys
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Drop the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('images');
        Schema::enableForeignKeyConstraints();
    }
}
