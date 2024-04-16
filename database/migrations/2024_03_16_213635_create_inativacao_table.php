<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInativacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inativacao', function (Blueprint $table) {
            $table->bigIncrements('id_inativacao');
            $table->unsignedInteger('paciente_id');
            $table->unsignedInteger('mi_id');
            $table->foreign('paciente_id')->references('id_paciente')->on('pacientes');
            $table->foreign('mi_id')->references('id_mi')->on('motivo_inativacao');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inativacao');
    }
}
