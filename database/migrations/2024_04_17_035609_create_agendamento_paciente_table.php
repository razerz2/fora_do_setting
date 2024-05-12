<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentoPacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamento_paciente', function (Blueprint $table) {
            $table->bigIncrements('id_apc');
            $table->unsignedInteger('agendamento_id');
            $table->unsignedInteger('paciente_id');
            $table->boolean('presencial');
            $table->foreign('agendamento_id')->references('id_agendamento')->on('agendamento');
            $table->foreign('paciente_id')->references('id_paciente')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamento_paciente');
    }
}
