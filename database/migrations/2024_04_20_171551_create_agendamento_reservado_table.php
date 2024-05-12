<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentoReservadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamento_reservado', function (Blueprint $table) {
            $table->bigIncrements('id_ar');
            $table->unsignedInteger('agendamento_id');
            $table->string('descricao');
            $table->boolean('presencial');
            $table->foreign('agendamento_id')->references('id_agendamento')->on('agendamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamento_reservado');
    }
}
