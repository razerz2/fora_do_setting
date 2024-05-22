<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessaoCanceladaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessao_cancelada', function (Blueprint $table) {
            $table->bigIncrements('id_sc');
            $table->unsignedInteger('agendamento_id');
            $table->unsignedInteger('sp_id');
            $table->unsignedInteger('vm_id');
            $table->unsignedInteger('paciente_id');
            $table->float('valor');
            $table->timestamp('data_registro');
            $table->foreign('agendamento_id')->references('id_agendamento')->on('agendamento');
            $table->foreign('sp_id')->references('id_sp')->on('sessao_paciente');
            $table->foreign('vm_id')->references('id_vm')->on('validacao_motivo');
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
        Schema::dropIfExists('sessao_cancelada');
    }
}
