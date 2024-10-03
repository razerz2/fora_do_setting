<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\PacienteGenero;
use App\Agendamento;
use App\AgendamentoPaciente;
use App\AgendamentoReservado;
use App\Sessao;
use App\SessaoPaciente;
use App\Pagamentos;
use App\GastosPessoais;
use App\GastosProfissionais;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RelatoriosController extends Controller
{
    public function indexRPacientes()
    {
        $generos = PacienteGenero::all();

        return view('relatorios.pacientes.index', compact('generos'));
    }

    public function indexRAgendamentos()
    {
        // Buscar todos os pacientes e ordenar por nome_paciente em ordem alfabética
        $pacientes = Paciente::orderBy('nome_paciente', 'asc')->get();

        // Retornar a view com os pacientes ordenados
        return view('relatorios.agendamentos.index', compact('pacientes'));
    }

    public function indexRPagamentos()
    {
        // Buscar todos os pacientes e ordenar por nome_paciente em ordem alfabética
        $pacientes = Paciente::orderBy('nome_paciente', 'asc')->get();

        // Retornar a view com os pacientes ordenados
        return view('relatorios.pagamentos.index', compact('pacientes'));
    }

    //Relatórios de Pacientes...

    public function PacientesAtivos()
    {
        // Buscar todos os pacientes com status ativo
        $pacientes = Paciente::where('status', 'ativo')->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados, 
        // mas você pode querer gerar um PDF ou outro formato)
        //return view('relatorios.pacientes_ativos', compact('pacientesAtivos'));
        dd($pacientes);
    }

    public function PacientesInativos()
    {
        // Buscar todos os pacientes com status ativo
        $pacientes = Paciente::where('status', 'inativo')->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados, 
        // mas você pode querer gerar um PDF ou outro formato)
        //return view('relatorios.pacientes_ativos', compact('pacientesAtivos'));
        dd($pacientes);
    }

    public function PacientesAdolescentes()
    {
        // Buscar todos os pacientes com idade abaixo de 18 anos
        $pacientes = Paciente::where('idade', '<', 18)->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados,
        // mas você pode querer gerar um PDF ou outro formato)
        //return view('relatorios.pacientes_menores', compact('pacientesMenores'));
        dd($pacientes);
    }

    public function PacientesAdultos()
    {
        // Buscar todos os pacientes com idade abaixo de 18 anos
        $pacientes = Paciente::where('idade', '>', 18)->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados,
        // mas você pode querer gerar um PDF ou outro formato)
        //return view('relatorios.pacientes_menores', compact('pacientesMenores'));
        dd($pacientes);
    }

    public function PacientesGenero(Request $request)
    {
        $data = $request->all();
        $pacientes = Paciente::where('genero_id', '=', $data['genero_id'])
            ->get();

        dd($pacientes);
    }

    //Relatórios de Agendamentos...

    public function AtendimentosOnline()
    {
        // Buscar todos os agendamentos online (presencial = false)
        $atendimentos = AgendamentoPaciente::select('agendamento_paciente.*', 'agendamento.n_dia', 'agendamento.ap_id', 'agendamento.horario_inicial')
            ->join('agendamento', 'agendamento_paciente.agendamento_id', '=', 'agendamento.id_agendamento')
            ->with(['agendamento', 'paciente'])
            ->where('agendamento_paciente.presencial', false)
            ->orderBy('agendamento.n_dia', 'asc')
            ->orderBy('agendamento.ap_id', 'asc')
            ->orderBy('agendamento.horario_inicial', 'asc')
            ->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados,
        // mas você pode querer gerar um PDF ou outro formato)
        //return view('relatorios.atendimentos_online', compact('atendimentosOnline'));
        dd($atendimentos);
    }

    public function AtendimentosPresenciais()
    {
        // Buscar todos os agendamentos presenciais (presencial = true)
        $atendimentos = AgendamentoPaciente::select('agendamento_paciente.*', 'agendamento.n_dia', 'agendamento.ap_id', 'agendamento.horario_inicial')
            ->join('agendamento', 'agendamento_paciente.agendamento_id', '=', 'agendamento.id_agendamento')
            ->with(['agendamento', 'paciente'])
            ->where('agendamento_paciente.presencial', true)
            ->orderBy('agendamento.n_dia', 'asc')
            ->orderBy('agendamento.ap_id', 'asc')
            ->orderBy('agendamento.horario_inicial', 'asc')
            ->get();


        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados,
        // mas você pode querer gerar um PDF ou outro formato)
        //return view('relatorios.atendimentos_online', compact('atendimentosOnline'));
        dd($atendimentos);
    }

    public function AtendimentosPorPaciente(Request $request)
    {
        $data = $request->all();

        $atendimentos = AgendamentoPaciente::select('agendamento_paciente.*', 'agendamento.n_dia', 'agendamento.ap_id', 'agendamento.horario_inicial')
            ->join('agendamento', 'agendamento_paciente.agendamento_id', '=', 'agendamento.id_agendamento')
            ->with(['agendamento', 'paciente'])
            ->where('agendamento_paciente.paciente_id', $data['id_paciente'])
            ->orderBy('agendamento.n_dia', 'asc')
            ->orderBy('agendamento.ap_id', 'asc')
            ->orderBy('agendamento.horario_inicial', 'asc')
            ->get();

        dd($atendimentos);
    }

    public function HorariosReservados()
    {
        // Buscar todos os agendamentos com at_id igual a 3 e carregar o relacionamento com agendamento_reservado
        $agendamentos = Agendamento::with('agendamentoReservado')
            ->where('at_id', 3)
            ->orderBy('n_dia', 'asc')
            ->orderBy('ap_id', 'asc')
            ->orderBy('horario_inicial', 'asc')
            ->get();

        dd($agendamentos);
    }

    public function HorariosLivres()
    {
        // Buscar todos os agendamentos com at_id igual a 2, que representam horários livres
        $agendamentos = Agendamento::where('at_id', 2)
            ->orderBy('n_dia', 'asc')
            ->orderBy('ap_id', 'asc')
            ->orderBy('horario_inicial', 'asc')
            ->get();

        dd($agendamentos);
    }

    //Relatórios de Pagamentos...

    public function PagamentosPorPaciente(Request $request)
    {
        $data = $request->all();
        
        // Buscar todos os pagamentos do paciente selecionado e ordenar por data_pagamento
        $pagamentos = Pagamentos::where('paciente_id', $data['id_paciente'])
        ->orderBy('data_pagamento', 'asc') // Ordenar por data_pagamento em ordem ascendente
        ->get();

        // Retornar a view com os dados dos pagamentos
        //return view('relatorios.pagamentos_por_paciente', compact('pagamentos'));

        dd($pagamentos);
    }

    public function PagamentosPorPeriodo(Request $request)
    {
        $data = $request->all();

        // Buscar todos os pagamentos dentro do período especificado
        $pagamentos = Pagamentos::whereBetween('data_pagamento', [$data['data_a'], $data['data_b']])
        ->orderBy('data_pagamento', 'asc')
        ->get();

        // Retornar a view com os dados dos pagamentos
        //return view('relatorios.pagamentos_por_periodo', compact('pagamentos', 'data_a', 'data_b'));

        dd($pagamentos);
    }

    public function PacientesRecibo()
    {
        // Buscar todos os registros onde o campo recibo é true e carregar o relacionamento paciente
        $pacientes = SessaoPaciente::with('paciente')->where('recibo', true)->get();

        // Retornar a view com os dados dos pacientes que solicitam recibos
        //return view('relatorios.pacientes_com_recibo', compact('pacientesComRecibo'));
        dd($pacientes);
    }

    public function PacientesInadimplentes()
    {
        // Data limite para considerar a sessão em atraso (30 dias atrás)
        $dataLimite = Carbon::now()->subDays(30);

        // Buscar todas as sessões em aberto e com mais de 30 dias
        $pacientes = Sessao::with('paciente') // Certifique-se de que o relacionamento 'paciente' está definido na model Sessao
            ->where('pagamento', false)
            ->where('data_sessao', '<', $dataLimite)
            ->get()
            ->unique('paciente_id'); // Remove duplicados por paciente_id

        // Retornar a view com os dados das sessões pendentes
        //return view('relatorios.pendencias_pagamento', compact('sessoesPendentes'));
        dd($pacientes);
    }

    //Relatório de Gastos Pessoais

    public function IndexGastosPessoais()
    {
        return view('relatorios.gastos_pessoais.index');
    }

    public function GastosPessoais()
    {
        // Obter o mês e ano atuais
        $now = Carbon::now();
        $mesAtual = $now->month;
        $anoAtual = $now->year;

        // Filtrar os gastos profissionais pelo mês e ano atuais
        $gastos = GastosPessoais::whereMonth('data_pagamento', $mesAtual)
            ->whereYear('data_pagamento', $anoAtual)
            ->get();

        // Exibir os resultados em uma view (ou gerar um PDF, se preferir)
        dd($gastos);
    }

    public function GastosPessoaisPeriodo(Request $request)
    {
        $data = $request->all();

        // Buscar todos os gastos dentro do período especificado
        $gastos = GastosPessoais::whereBetween('data_pagamento', [$data['data_a'], $data['data_b']])
        ->orderBy('data_pagamento', 'asc')
        ->get();

        // Retornar a view com os dados dos gastos
        dd($gastos);
    }

    //Relatório de Gastos Profissionais

    public function IndexGastosProfissionais()
    {
        return view('relatorios.gastos_profissionais.index');
    }

    public function GastosProfissionais()
    {
        // Obter o mês e ano atuais
        $now = Carbon::now();
        $mesAtual = $now->month;
        $anoAtual = $now->year;

        // Filtrar os gastos profissionais pelo mês e ano atuais
        $gastos = GastosProfissionais::whereMonth('data_pagamento', $mesAtual)
            ->whereYear('data_pagamento', $anoAtual)
            ->get();

        // Exibir os resultados em uma view (ou gerar um PDF, se preferir)
        dd($gastos);
    }

    public function GastosProfissionaisPeriodo(Request $request)
    {
        $data = $request->all();

        // Buscar todos os gastos dentro do período especificado
        $gastos = GastosProfissionais::whereBetween('data_pagamento', [$data['data_a'], $data['data_b']])
        ->orderBy('data_pagamento', 'asc')
        ->get();

        // Retornar a view com os dados dos gastos
        dd($gastos);
    }

}
