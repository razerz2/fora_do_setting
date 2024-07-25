<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosPessoaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_pessoais', function (Blueprint $table) {
            $table->bigIncrements('id_gpe');
            $table->string('despesa');
            $table->string('observacao');
            $table->date('data_vencimento');
            $table->date('data_pagamento');
            $table->float('valor_despesa');
            $table->boolean('recursivo');
            $table->integer('dia_vencimento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastos_pessoais');
    }
}
