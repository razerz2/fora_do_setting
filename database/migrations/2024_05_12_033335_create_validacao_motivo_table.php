<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidacaoMotivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validacao_motivo', function (Blueprint $table) {
            $table->bigIncrements('id_vm');
            $table->string('nome_motivo');
            $table->string('descricao_motivo');
            $table->boolean('sistemico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validacao_motivo');
    }
}
