<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->bigIncrements('id_pagamento');
            $table->unsignedInteger('paciente_id');
            $table->integer('dia_vencimento');
            $table->float('valor_pagamento');
            $table->date('data_pagamento');
            $table->string('mes_referente');
            $table->integer('n_mes_referente');
            $table->integer('ano_referente');
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
        Schema::dropIfExists('pagamentos');
    }
}
