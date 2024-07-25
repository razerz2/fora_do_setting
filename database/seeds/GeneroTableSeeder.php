<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array com os dados dos tipos de agendamento a serem inseridas
        $generos = [
            [
                'nome_genero' => 'Feminino',
                'abreviatura' => 'F',
                'registro_sistemico' => true
            ],
            [
                'nome_genero' => 'Masculino',
                'abreviatura' => 'M',
                'registro_sistemico' => true
            ]
            // Adicione mais registros conforme necessário
        ];

        // Inserir os registros na tabela de permissões
        DB::table('pacientes_genero')->insert($generos);
    }
}
