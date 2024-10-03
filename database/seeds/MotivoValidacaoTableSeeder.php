<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivoValidacaoTableSeeder extends Seeder
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
                'id_vm' => 1,
                'nome_motivo' => 'Desistência',
                'descricao_motivo' => 'Paciente desistiu da Sessão',
                'registro_sistemico' => true
            ]
            // Adicione mais registros conforme necessário
        ];

        // Inserir os registros na tabela de motivos da inativaçãp
        DB::table('validacao_motivo')->insert($motivos);
    }
}
