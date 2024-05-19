<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessaoHistoricoReajusteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessao_historico_reajuste', function (Blueprint $table) {
            $table->bigIncrements('id_shr');
            $table->unsignedInteger('sp_id');
            $table->unsignedInteger('paciente_id');
            $table->integer('dia_vencimento');
            $table->float('valor');
            $table->timestamp('data_reajuste');
            $table->foreign('sp_id')->references('id_sp')->on('sessao_paciente');
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
        Schema::dropIfExists('sessao_historico_reajuste');
    }
}
