<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidacaoAgendamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validacao_agendamento', function (Blueprint $table) {
            $table->bigIncrements('id_va');
            $table->unsignedInteger('agendamento_id');
            $table->unsignedInteger('vm_id');
            $table->boolean('status');
            $table->timestamp('data_registro');
            $table->foreign('agendamento_id')->references('id_agendamento')->on('agendamento');
            $table->foreign('vm_id')->references('id_vm')->on('validacao_motivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validacao_agendamento');
    }
}
