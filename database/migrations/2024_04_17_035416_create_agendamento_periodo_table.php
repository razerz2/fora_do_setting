<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentoPeriodoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamento_periodo', function (Blueprint $table) {
            $table->bigIncrements('id_ap');
            $table->string('periodo');
            $table->time('hora_inicial');
            $table->time('hora_final');
            $table->boolean('registro_sistemico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamento_periodo');
    }
}
