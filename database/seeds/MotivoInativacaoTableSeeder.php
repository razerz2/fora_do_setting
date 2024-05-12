<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivoInativacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array com os dados dos motivos de inativação a serem inseridas
        $motivos = [
            [
                'id_mi' => 1,
                'nome_mi' => 'Desistência',
                'descricao_mi' => 'Paciente desistiu do tratamento',
                'registro_sistemico' => true
            ]
            // Adicione mais registros conforme necessário
        ];

        // Inserir os registros na tabela de motivos da inativaçãp
        DB::table('motivo_inativacao')->insert($motivos);
    }
}
