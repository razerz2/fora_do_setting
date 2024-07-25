<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id_paciente');
            $table->string('nome_paciente');
            $table->string('rg')->nullable();
            $table->string('cpf');
            $table->date('data_nascimento');
            $table->integer('idade');
            $table->unsignedInteger('genero_id');
            $table->string('email');
            $table->string('telefone_1');
            $table->string('resp_tel_1')->nullable();
            $table->string('telefone_2')->nullable();
            $table->string('resp_tel_2')->nullable();
            $table->string('status');
            $table->foreign('genero_id')->references('id_genero')->on('pacientes_genero');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}