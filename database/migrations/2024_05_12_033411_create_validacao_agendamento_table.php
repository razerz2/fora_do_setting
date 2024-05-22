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
            $table->timestamp('data_registro');
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
        Schema::dropIfExists('validacao_agendamento');
    }
}
