<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgendamentoPeriodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array com os dados dos períodos a serem inseridos
       $periodos = [
        [
            'id_ap' => 1,
            'periodo' => 'Manhã',
            'hora_inicial' => '07:00',
            'hora_final' => '13:00',
            'registro_sistemico' => true,
        ],
        [
            'id_ap' => 2,
            'periodo' => 'Tarde',
            'hora_inicial' => '13:00',
            'hora_final' => '19:00',
            'registro_sistemico' => true,
        ],
        [
            'id_ap' => 3,
            'periodo' => 'Noite',
            'hora_inicial' => '19:00',
            'hora_final' => '22:00',
            'registro_sistemico' => true,
        ]
        // Adicione mais registros conforme necessário
    ];

    // Inserir os registros na tabela de períodos
    DB::table('agendamento_periodo')->insert($periodos);
    }
}
