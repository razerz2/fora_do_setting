<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentosSessoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos_sessoes', function (Blueprint $table) {
            $table->bigIncrements('id_pg');
            $table->unsignedInteger('pagamento_id');
            $table->unsignedInteger('sessao_id');
            $table->float('valor');
            $table->foreign('pagamento_id')->references('id_pagamento')->on('pagamentos');
            $table->foreign('sessao_id')->references('id_sessao')->on('sessao');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos_sessoes');
    }
}
