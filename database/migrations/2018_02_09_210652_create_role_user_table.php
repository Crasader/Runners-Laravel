<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateRoleUserTable
 * 
 * @author Bastien Nicoud
 */
class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            // Foreing keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
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
        Schema::table('role_user', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'role_id']);
        });

        // Drop the table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('role_user');
        Schema::enableForeignKeyConstraints();
    }
}
