<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessao', function (Blueprint $table) {
            $table->bigIncrements('id_sessao');
            $table->unsignedInteger('sp_id');
            $table->unsignedInteger('paciente_id');
            $table->float('valor_sessao');
            $table->timestamp('data_sessao');
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
        Schema::dropIfExists('sessao');
    }
}
