<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateStatusTable
 * Sores all the possibles status in the app
 *
 * @author Bastien Nicoud
 */
class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            // Store the type of resource where the status can be user
            $table->string('type');
            // Slug of the status
            $table->string('slug', 60);
            // Optionnal description for the status
            $table->mediumText('description')->nullable();
            // Allows you to filter status filtred in the kelas page
            $table->boolean('shows_on_kiela')->default(false);
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
        Schema::dropIfExists('statuses');
    }
}
