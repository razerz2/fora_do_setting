<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["id_estado" => "01", "pais_id" => "31", "uf" => "AC", "nome_estado" => "Acre"],
            ["id_estado" => "02", "pais_id" => "31","uf" => "AL", "nome_estado" => "Alagoas"],
            ["id_estado" => "03", "pais_id" => "31", "uf" => "AM", "nome_estado" => "Amazonas"],
            ["id_estado" => "04", "pais_id" => "31", "uf" => "AP", "nome_estado" => "Amapá"],
            ["id_estado" => "05", "pais_id" => "31", "uf" => "BA", "nome_estado" => "Bahia"],
            ["id_estado" => "06", "pais_id" => "31", "uf" => "CE", "nome_estado" => "Ceará"],
            ["id_estado" => "07", "pais_id" => "31", "uf" => "DF", "nome_estado" => "Distrito Federal"],
            ["id_estado" => "08", "pais_id" => "31", "uf" => "ES", "nome_estado" => "Espírito Santo"],
            ["id_estado" => "09", "pais_id" => "31", "uf" => "GO", "nome_estado" => "Goiás"],
            ["id_estado" => "10", "pais_id" => "31", "uf" => "MA", "nome_estado" => "Maranhão"],
            ["id_estado" => "11", "pais_id" => "31", "uf" => "MG", "nome_estado" => "Minas Gerais"],
            ["id_estado" => "12", "pais_id" => "31", "uf" => "MS", "nome_estado" => "Mato Grosso do Sul"],
            ["id_estado" => "13", "pais_id" => "31", "uf" => "MT", "nome_estado" => "Mato Grosso"],
            ["id_estado" => "14", "pais_id" => "31", "uf" => "PA", "nome_estado" => "Pará"],
            ["id_estado" => "15", "pais_id" => "31", "uf" => "PB", "nome_estado" => "Paraíba"],
            ["id_estado" => "16", "pais_id" => "31", "uf" => "PE", "nome_estado" => "Pernambuco"],
            ["id_estado" => "17", "pais_id" => "31", "uf" => "PI", "nome_estado" => "Piauí"],
            ["id_estado" => "18", "pais_id" => "31", "uf" => "PR", "nome_estado" => "Paraná"],
            ["id_estado" => "19", "pais_id" => "31", "uf" => "RJ", "nome_estado" => "Rio de Janeiro"],
            ["id_estado" => "20", "pais_id" => "31", "uf" => "RN", "nome_estado" => "Rio Grande do Norte"],
            ["id_estado" => "21", "pais_id" => "31", "uf" => "RO", "nome_estado" => "Rondônia"],
            ["id_estado" => "22", "pais_id" => "31", "uf" => "RR", "nome_estado" => "Roraima"],
            ["id_estado" => "23", "pais_id" => "31", "uf" => "RS", "nome_estado" => "Rio Grande do Sul"],
            ["id_estado" => "24", "pais_id" => "31", "uf" => "SC", "nome_estado" => "Santa Catarina"],
            ["id_estado" => "25", "pais_id" => "31", "uf" => "SE", "nome_estado" => "Sergipe"],
            ["id_estado" => "26", "pais_id" => "31", "uf" => "SP", "nome_estado" => "São Paulo"],
            ["id_estado" => "27", "pais_id" => "31", "uf" => "TO", "nome_estado" => "Tocantins"]
        ];

        DB::table('estados')->insert($data);

        // Ajuste a sequência do PostgreSQL para que o próximo valor seja 28
        DB::statement("SELECT setval(pg_get_serial_sequence('estados', 'id_estado'), 28, false)");
        
    }
}