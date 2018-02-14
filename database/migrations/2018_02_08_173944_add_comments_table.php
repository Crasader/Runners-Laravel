<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('commentable_id')->unsigned();
            $table->string('commentable_type');
            $table->text('content');
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
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Drop the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('comments');
        Schema::enableForeignKeyConstraints();
    }
}
