<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * AddAttachmentsTable
 * 
 * @author Bastien Nicoud
 */
class AddAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('attachable_id')->unsigned()->nullable();
            $table->string('attachable_type')->nullable();
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
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Drop the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('attachments');
        Schema::enableForeignKeyConstraints();
    }
}
