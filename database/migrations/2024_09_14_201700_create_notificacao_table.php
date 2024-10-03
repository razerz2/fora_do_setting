<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacao', function (Blueprint $table) {
            $table->bigIncrements('id_notificacao');
            $table->unsignedInteger('user_id');
            $table->string('route');
            $table->string('message', 65535);
            $table->timestamp('data_registro');
            $table->boolean('verificado');
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
        Schema::dropIfExists('notificacao');
    }
}
