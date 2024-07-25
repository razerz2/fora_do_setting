<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosProfissionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_profissional', function (Blueprint $table) {
            $table->bigIncrements('id_gpr');
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
        Schema::dropIfExists('gastos_profissional');
    }
}
