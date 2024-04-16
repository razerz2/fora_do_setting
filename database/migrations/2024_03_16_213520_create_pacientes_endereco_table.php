<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesEnderecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes_endereco', function (Blueprint $table) {
            $table->bigIncrements('id_ep');
            $table->unsignedInteger('paciente_id');
            $table->unsignedInteger('pais_id');
            $table->unsignedInteger('estado_id');
            $table->unsignedInteger('cidade_id');
            $table->string('endereco');
            $table->string('n_endereco');
            $table->string('complemento')->nullable();
            $table->string('cep');
            $table->foreign('paciente_id')->references('id_paciente')->on('pacientes');
            $table->foreign('pais_id')->references('id_pais')->on('paises');
            $table->foreign('estado_id')->references('id_estado')->on('estados');
            $table->foreign('cidade_id')->references('id_cidade')->on('cidades');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes_endereco');
    }
}