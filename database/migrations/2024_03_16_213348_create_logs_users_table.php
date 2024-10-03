<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_users', function (Blueprint $table) {
            $table->bigIncrements('id_logs');
            $table->unsignedInteger('user_id');
            $table->string('route');
            $table->string('action');
            $table->string('content', 65535);
            $table->timestamp('data_registro');
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
        Schema::dropIfExists('logs_users');
    }
}