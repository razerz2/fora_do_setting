<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamento', function (Blueprint $table) {
            $table->bigIncrements('id_agendamento');
            $table->unsignedInteger('ap_id');
            $table->unsignedInteger('at_id');
            $table->string('dia');
            $table->integer('n_dia');
            $table->time('horario_inicial');
            $table->time('horario_final');
            $table->timestamp('data_registro');
            $table->foreign('ap_id')->references('id_ap')->on('agendamento_periodo');
            $table->foreign('at_id')->references('id_at')->on('agendamento_tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamento');
    }
}
