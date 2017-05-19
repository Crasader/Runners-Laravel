<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccessTokenToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if(strtolower(env("DB_CONNECTION")) == "sqlite"){
        Schema::table('users', function (Blueprint $table) {
          $table->string('accesstoken')->unique()->nullable();
        });
      }
      else{
        Schema::table('users', function (Blueprint $table) {
          $table->string('accesstoken')->unique();
        });
      }
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("accesstoken");
        });
    }
}
