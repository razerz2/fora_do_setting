<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessaoPacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessao_paciente', function (Blueprint $table) {
            $table->bigIncrements('id_sp');
            $table->unsignedInteger('paciente_id');
            $table->integer('dia_vencimento');
            $table->float('valor_sessao');
            $table->timestamp('data_registro');
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
        Schema::dropIfExists('sessao_paciente');
    }
}
