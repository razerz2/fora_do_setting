<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgendamentoTipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array com os dados dos tipos de agendamento a serem inseridas
        $tipos_agendamentos = [
            [
                'id_at' => 1,
                'tipo_agendamento' => 'Atendimento',
                'descricao' => 'horário para atendimento ao paciente',
                'registro_sistemico' => true
            ],
            [
                'id_at' => 2,
                'tipo_agendamento' => 'Livre',
                'descricao' => 'Sem nenhum horário reservado',
                'registro_sistemico' => true
            ],[
                'id_at' => 3,
                'tipo_agendamento' => 'Reservado',
                'descricao' => 'Sem nenhum horário reservado',
                'registro_sistemico' => true
            ]
            // Adicione mais registros conforme necessário
        ];

        // Inserir os registros na tabela de permissões
        DB::table('agendamento_tipo')->insert($tipos_agendamentos);
    }
}
