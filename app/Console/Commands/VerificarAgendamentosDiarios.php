<?php

namespace App\Console\Commands;

use App\Agendamento;
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
        $diaHoje = now()->format('Y-m-d'); // Obtém a data de hoje
        $horarioAtual = now()->toTimeString(); // Obtém o horário atual

        // Exclui os registros de validação feitos hoje
        ValidacaoAgendamento::whereDate('data_registro', $diaHoje)->delete();

        $agendamentos = Agendamento::where('at_id', 1)->get();
        $registrosCriados = 0;

        foreach ($agendamentos as $agendamento) {
            if ($agendamento->n_dia == $diaDaSemana) {
                // Obtém o horário final do agendamento
                $horarioFinalAgendamento = $agendamento->horario_final;
                
                // Verifica se o horário atual é maior que o horário final do agendamento
                if ($horarioAtual > $horarioFinalAgendamento) {
                    ValidacaoAgendamento::create([
                        'agendamento_id' => $agendamento->id_agendamento,
                        'vm_id' => 1,
                        'status' => false,
                        'data_registro' => now(),
                    ]);
                    $registrosCriados++;
                }
            }
        }

        $this->info("Verificação diária de agendamentos concluída. $registrosCriados registros realizados.");
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
}
