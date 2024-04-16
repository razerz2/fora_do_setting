<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array com os dados das permissões a serem inseridas
        $permissoes = [
            [
                'user_id' => 1,
                'area_sistema' => 'agenda',
                'permissao' => true,
            ],
            [
                'user_id' => 1,
                'area_sistema' => 'pacientes',
                'permissao' => true,
            ],
            [
                'user_id' => 1,
                'area_sistema' => 'pagamentos',
                'permissao' => true,
            ],
            [
                'user_id' => 1,
                'area_sistema' => 'sessoes',
                'permissao' => true,
            ],
            [
                'user_id' => 1,
                'area_sistema' => 'gastos_pessoais',
                'permissao' => true,
            ],
            [
                'user_id' => 1,
                'area_sistema' => 'gastos_profissionais',
                'permissao' => true,
            ],
            [
                'user_id' => 1,
                'area_sistema' => 'relatorios',
                'permissao' => true,
            ],
            [
                'user_id' => 1,
                'area_sistema' => 'sistema',
                'permissao' => true,
            ]
            // Adicione mais registros conforme necessário
        ];

        // Inserir os registros na tabela de permissões
        DB::table('permissoes_users')->insert($permissoes);
    }
}
