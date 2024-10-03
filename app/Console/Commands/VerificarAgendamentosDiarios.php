<?php

namespace App\Console\Commands;

use App\Agendamento;
use App\Sessao;
use App\SessaoCancelada;
use App\User;
use App\Notificacao;
use App\ValidacaoAgendamento;
use Carbon\Carbon;
use Illuminate\Console\Command;

class VerificarAgendamentosDiarios extends Command
{
    protected $signature = 'verificar:agendamentos';

    protected $description = 'Verifica os agendamentos diariamente e cadastra na tabela de validação';

    public function handle()
    {
        $diaDaSemana = $this->semanaPadraoSistema();
        $horarioAtual = now()->toTimeString(); // Obtém o horário atual

        $agendamentos = Agendamento::where('at_id', 1)->get();
        $registrosCriados = 0;

        foreach ($agendamentos as $agendamento) {
            if ($agendamento->n_dia == $diaDaSemana && !$this->verificarRegistroVA($agendamento->id_agendamento) 
                && !$this->verificarRegistroSessao($agendamento->id_agendamento) && !$this->verificarRegistroSC($agendamento->id_agendamento))
            {
                // Obtém o horário final do agendamento
                $horarioFinalAgendamento = $agendamento->horario_final;

                // Verifica se o horário atual é maior que o horário final do agendamento
                if ($horarioAtual > $horarioFinalAgendamento) {
                    ValidacaoAgendamento::create([
                        'agendamento_id' => $agendamento->id_agendamento,
                        'data_registro' => now(),
                    ]);
                    $registrosCriados++;
                }
            }
        }

        $this->info("Verificação diária de agendamentos concluída. $registrosCriados registros realizados.");
        $this->registrarNotificacao("Verificação diária de agendamentos concluída. $registrosCriados registros realizados.");
        \Log::info("Verificação diária de agendamentos concluída. $registrosCriados registros realizados.");
    }

    public function semanaPadraoSistema()
    {

        $dia = Carbon::now()->dayOfWeek; // Obtém o dia da semana atual (0 para domingo, 1 para segunda, etc.)

        if ($dia == 0) {
            // 0 para domingo, retorna 7
            return 7;
        } else if ($dia == 1) {
            // 1 para segunda, retorna 1
            return 1;
        } else if ($dia == 2) {
            // 2 para terça, retorna 2
            return 2;
        } else if ($dia == 3) {
            // 3 para quarta, retorna 3
            return 3;
        } else if ($dia == 4) {
            // 4 para quinta, retorna 4
            return 4;
        } else if ($dia == 5) {
            // 5 para sexta, retorna 5
            return 5;
        } else if ($dia == 6) {
            // 6 para sábado, retorna 6
            return 6;
        }
    }

    public function verificarRegistroVA($agendamento_id)
    {
        $hoje = Carbon::today();

        $registroExiste = ValidacaoAgendamento::where('agendamento_id', $agendamento_id)
            ->whereDate('data_registro', $hoje)
            ->exists();

        if ($registroExiste) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarRegistroSessao($agendamento_id)
    {
        $hoje = Carbon::today();

        $registroExiste = Sessao::where('agendamento_id', $agendamento_id)
            ->whereDate('data_sessao', $hoje)
            ->exists();

        if ($registroExiste) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarRegistroSC($agendamento_id)
    {
        $hoje = Carbon::today();

        $registroExiste = SessaoCancelada::where('agendamento_id', $agendamento_id)
            ->whereDate('data_registro', $hoje)
            ->exists();

        if ($registroExiste) {
            return true;
        } else {
            return false;
        }
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
