<?php

namespace App\Console\Commands;

use App\GastosPessoais;
use App\User;
use App\Notificacao;
use Illuminate\Console\Command;
use Carbon\Carbon;

class VerificarGastosPessoais extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gastos_pessoais:verificar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica gastos recursivos e cria novos registros com a data de pagamento atual se o dia_vencimento for hoje.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Data atual
        $today = Carbon::now();
        $diaHoje = $today->day;

        // Busca os registros onde recursivo = true e dia_vencimento = dia atual
        $gastos = GastosPessoais::where('recursivo', true)
            ->where('dia_vencimento', $diaHoje)
            ->get();

        $registrosCriados = 0;

        foreach ($gastos as $gasto) {
            // Cria um novo registro com os dados encontrados e atualiza data_pagamento para a data de hoje
            GastosPessoais::create([
                'despesa' => $gasto->despesa,
                'observacao' => $gasto->observacao,
                'data_vencimento' => $gasto->data_vencimento, // ou atualize conforme necessário
                'data_pagamento' => $today->toDateString(), // Data de pagamento igual a hoje
                'valor_despesa' => $gasto->valor_despesa,
                'recursivo' => $gasto->recursivo,
                'dia_vencimento' => $gasto->dia_vencimento
            ]);

            $registrosCriados++;
        }

        $this->info("Verificação de gastos pessoais recursivos concluída.. $registrosCriados registros realizados.");
        $this->registrarNotificacao("Verificação de gastos pessoais recursivos concluída.. $registrosCriados registros realizados.");
        \Log::info("Verificação de gastos pessoais recursivos concluída.. $registrosCriados registros realizados.");
        return 0;
    }

    public function registrarNotificacao($message)
    {
        $users = User::where('status', 'ativo')->get();

        foreach ($users as $user) {
            Notificacao::create([
                'user_id' => $user->id,
                'route' => 'Agendamento',
                'data_vencimento' => $message,
                'data_registro' => now(), // Data de hoje
                'verificado' => false
            ]);
        }
    }
}