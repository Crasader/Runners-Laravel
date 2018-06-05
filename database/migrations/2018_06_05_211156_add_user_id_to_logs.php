<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * AddLogsTable
 *
 * @author Bastien Nicoud
 */
class AddUserIdToLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->after('action');

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
        Schema::table('logs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        // Drop the column
        Schema::table('logs', function (Blueprint $table) {
            $table->dropColumn(['user_id']);
        });
    }
}
