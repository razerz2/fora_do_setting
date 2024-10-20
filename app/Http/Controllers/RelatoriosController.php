<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\PacienteGenero;
use App\Agendamento;
use App\AgendamentoPaciente;
use App\Sessao;
use App\SessaoPaciente;
use App\Pagamentos;
use App\GastosPessoais;
use App\GastosProfissionais;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $dados = Paciente::where('status', 'ativo')
            ->orderBy('nome_paciente', 'ASC')
            ->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados, 
        // mas você pode querer gerar um PDF ou outro formato)
        return view('relatorios.pacientes.pacientes_ativos', compact('dados'));
    }

    public function PacientesInativos()
    {
        // Buscar todos os pacientes com status ativo
        $dados = Paciente::where('status', 'inativo')
            ->orderBy('nome_paciente', 'ASC')
            ->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados, 
        // mas você pode querer gerar um PDF ou outro formato)
        return view('relatorios.pacientes.pacientes_inativos', compact('dados'));
    }

    public function PacientesAdolescentes()
    {
        // Buscar todos os pacientes com idade abaixo de 18 anos
        $dados = Paciente::where('idade', '<', 18)
            ->orderBy('nome_paciente', 'ASC')
            ->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados,
        // mas você pode querer gerar um PDF ou outro formato)
        return view('relatorios.pacientes.pacientes_adolescentes', compact('dados'));
    }

    public function PacientesAdultos()
    {
        // Buscar todos os pacientes com idade abaixo de 18 anos
        $dados = Paciente::where('idade', '>', 18)
            ->orderBy('nome_paciente', 'ASC')
            ->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados,
        // mas você pode querer gerar um PDF ou outro formato)
        return view('relatorios.pacientes.pacientes_adultos', compact('dados'));
    }

    public function PacientesGenero(Request $request)
    {
        $data = $request->all();
        $genero = PacienteGenero::find($data['genero_id']);
        $dados = Paciente::where('genero_id', '=', $data['genero_id'])
            ->orderBy('nome_paciente', 'ASC')
            ->get();

        return view('relatorios.pacientes.pacientes_genero', compact('dados', 'genero'));
    }

    //Relatórios de Agendamentos...

    public function AtendimentosOnline()
    {
        // Buscar todos os agendamentos online (presencial = false)
        $dados = AgendamentoPaciente::select(
            'agendamento_paciente.id_apc AS id',
            'pacientes.nome_paciente',
            'agendamento_tipo.tipo_agendamento AS tipo',
            'agendamento.dia AS dia_semana',
            'agendamento_periodo.periodo',
            'agendamento.horario_inicial',
            'agendamento.horario_final'
        )
            ->join('pacientes', 'agendamento_paciente.paciente_id', '=', 'pacientes.id_paciente')
            ->join('agendamento', 'agendamento_paciente.agendamento_id', '=', 'agendamento.id_agendamento')
            ->join('agendamento_periodo', 'agendamento.ap_id', '=', 'agendamento_periodo.id_ap')
            ->join('agendamento_tipo', 'agendamento.at_id', '=', 'agendamento_tipo.id_at')
            ->with(['agendamento', 'paciente'])
            ->where('agendamento_paciente.presencial', false)
            ->orderBy('agendamento.n_dia', 'asc')
            ->orderBy('agendamento.ap_id', 'asc')
            ->orderBy('agendamento.horario_inicial', 'asc')
            ->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados,
        // mas você pode querer gerar um PDF ou outro formato)
        return view('relatorios.agendamentos.atendimento_online', compact('dados'));
    }

    public function AtendimentosPresenciais()
    {
        // Buscar todos os agendamentos presenciais (presencial = true)
        $dados = AgendamentoPaciente::select(
            'agendamento_paciente.id_apc AS id',
            'pacientes.nome_paciente',
            'agendamento_tipo.tipo_agendamento AS tipo',
            'agendamento.dia AS dia_semana',
            'agendamento_periodo.periodo',
            'agendamento.horario_inicial',
            'agendamento.horario_final'
        )
            ->join('pacientes', 'agendamento_paciente.paciente_id', '=', 'pacientes.id_paciente')
            ->join('agendamento', 'agendamento_paciente.agendamento_id', '=', 'agendamento.id_agendamento')
            ->join('agendamento_periodo', 'agendamento.ap_id', '=', 'agendamento_periodo.id_ap')
            ->join('agendamento_tipo', 'agendamento.at_id', '=', 'agendamento_tipo.id_at')
            ->with(['agendamento', 'paciente'])
            ->where('agendamento_paciente.presencial', true)
            ->orderBy('agendamento.n_dia', 'asc')
            ->orderBy('agendamento.ap_id', 'asc')
            ->orderBy('agendamento.horario_inicial', 'asc')
            ->get();


        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados,
        // mas você pode querer gerar um PDF ou outro formato)
        return view('relatorios.agendamentos.atendimento_presenciais', compact('dados'));
    }

    public function AtendimentosPorPaciente(Request $request)
    {
        $data = $request->all();
        $paciente = Paciente::find($data['id_paciente']);
        $dados = AgendamentoPaciente::select(
            'agendamento_paciente.id_apc AS id',
            'pacientes.nome_paciente',
            'agendamento_tipo.tipo_agendamento AS tipo',
            'agendamento.dia AS dia_semana',
            'agendamento_periodo.periodo',
            'agendamento.horario_inicial',
            'agendamento.horario_final'
        )
            ->join('pacientes', 'agendamento_paciente.paciente_id', '=', 'pacientes.id_paciente')
            ->join('agendamento', 'agendamento_paciente.agendamento_id', '=', 'agendamento.id_agendamento')
            ->join('agendamento_periodo', 'agendamento.ap_id', '=', 'agendamento_periodo.id_ap')
            ->join('agendamento_tipo', 'agendamento.at_id', '=', 'agendamento_tipo.id_at')
            ->where('agendamento_paciente.paciente_id', $data['id_paciente'])
            ->orderBy('agendamento.n_dia', 'asc')
            ->orderBy('agendamento.ap_id', 'asc')
            ->orderBy('agendamento.horario_inicial', 'asc')
            ->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados,
        // mas você pode querer gerar um PDF ou outro formato)
        return view('relatorios.agendamentos.atendimento_paciente', compact('paciente', 'dados'));
    }

    public function HorariosReservados()
    {
        // Buscar todos os agendamentos com at_id igual a 3 e carregar o relacionamento com agendamento_reservado
        $dados = Agendamento::select(
            'agendamento.id_agendamento',
            'agendamento_tipo.tipo_agendamento AS tipo',
            'agendamento.dia AS dia_semana',
            'agendamento_periodo.periodo',
            'agendamento.horario_inicial',
            'agendamento.horario_final'
        )
            ->join('agendamento_periodo', 'agendamento.ap_id', '=', 'agendamento_periodo.id_ap')
            ->join('agendamento_tipo', 'agendamento.at_id', '=', 'agendamento_tipo.id_at')
            ->where('at_id', 3)
            ->orderBy('n_dia', 'asc')
            ->orderBy('ap_id', 'asc')
            ->orderBy('horario_inicial', 'asc')
            ->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados,
        // mas você pode querer gerar um PDF ou outro formato)
        return view('relatorios.agendamentos.horarios_reservados', compact('dados'));
    }

    public function HorariosLivres()
    {
        // Buscar todos os agendamentos com at_id igual a 2, que representam horários livres
        $dados = Agendamento::select(
            'agendamento.id_agendamento',
            'agendamento_tipo.tipo_agendamento AS tipo',
            'agendamento.dia AS dia_semana',
            'agendamento_periodo.periodo',
            'agendamento.horario_inicial',
            'agendamento.horario_final'
        )
            ->join('agendamento_periodo', 'agendamento.ap_id', '=', 'agendamento_periodo.id_ap')
            ->join('agendamento_tipo', 'agendamento.at_id', '=', 'agendamento_tipo.id_at')
            ->where('at_id', 2)
            ->orderBy('n_dia', 'asc')
            ->orderBy('ap_id', 'asc')
            ->orderBy('horario_inicial', 'asc')
            ->get();

        // Gerar o relatório (neste exemplo, estamos apenas retornando os dados,
        // mas você pode querer gerar um PDF ou outro formato)
        return view('relatorios.agendamentos.horarios_livre', compact('dados'));
    }

    //Relatórios de Pagamentos...

    public function PagamentosPorPaciente(Request $request)
    {
        $data = $request->all();

        // Buscar todos os pagamentos do paciente selecionado e ordenar por data_pagamento
        $paciente = Paciente::find($data['id_paciente']);
        $dados = Pagamentos::select(
            'pagamentos.id_pagamento',
            'pacientes.nome_paciente AS paciente',
            'pagamentos.dia_vencimento',
            'pagamentos.valor_pagamento',
            'pagamentos.mes_referente',
            'pagamentos.ano_referente',
            'pagamentos.data_pagamento'
        )
            ->join('pacientes', 'pagamentos.paciente_id', '=', 'pacientes.id_paciente')
            ->where('paciente_id', $data['id_paciente'])
            ->orderBy('data_pagamento', 'asc') // Ordenar por data_pagamento em ordem ascendente
            ->get();

        // Formatar a data_pagamento para o formato "d/m/Y"
        $dados->transform(function ($item) {
            $item->data_pagamento = \Carbon\Carbon::parse($item->data_pagamento)->format('d/m/Y');
            return $item;
        });

        // Retornar a view com os dados dos pagamentos
        return view('relatorios.pagamentos.pagamentos_paciente', compact('paciente', 'dados'));
    }

    public function PagamentosPorPeriodo(Request $request)
    {
        $data = $request->all();
        $data_a = \Carbon\Carbon::parse($data['data_a'])->format('d/m/Y');
        $data_b = \Carbon\Carbon::parse($data['data_b'])->format('d/m/Y');

        // Buscar todos os pagamentos dentro do período especificado
        $dados = Pagamentos::select(
            'pagamentos.id_pagamento',
            'pacientes.nome_paciente AS paciente',
            'pagamentos.dia_vencimento',
            'pagamentos.valor_pagamento',
            'pagamentos.mes_referente',
            'pagamentos.ano_referente',
            'pagamentos.data_pagamento'
        )
            ->join('pacientes', 'pagamentos.paciente_id', '=', 'pacientes.id_paciente')
            ->whereBetween('data_pagamento', [$data['data_a'], $data['data_b']])
            ->orderBy('data_pagamento', 'asc')
            ->get();
        // Formatar a data_pagamento para o formato "d/m/Y"
        $dados->transform(function ($item) {
            $item->data_pagamento = \Carbon\Carbon::parse($item->data_pagamento)->format('d/m/Y');
            return $item;
        });
        // Retornar a view com os dados dos pagamentos
        return view('relatorios.pagamentos.pagamentos_periodos', compact('dados', 'data_a', 'data_b'));
    }

    public function PacientesInadimplentes()
    {
        // Data limite para considerar a sessão em atraso (30 dias atrás)
        $dataLimite = Carbon::now()->subDays(30);

        // Buscar todos os pacientes com sessões em aberto e com mais de 30 dias
        $dados = Sessao::select(
            'pacientes.id_paciente AS id',
            'pacientes.nome_paciente AS paciente',
            DB::raw('COUNT(sessao.id_sessao) AS total_sessoes'),
            DB::raw('SUM(sessao.valor_sessao) AS valor_total'),
        )
            ->join('pacientes', 'sessao.paciente_id', '=', 'pacientes.id_paciente')
            ->where('sessao.pagamento', '=', FALSE) // Filtrar apenas registros com pagamento igual a false
            ->where('sessao.data_sessao', '<', $dataLimite)
            ->groupBy('pacientes.id_paciente', 'pacientes.nome_paciente') // Agrupar por paciente
            ->orderBy('nome_paciente', 'asc')
            ->get();

        // Retornar a view com os dados dos pacientes inadimplentes
        return view('relatorios.pagamentos.pacientes_inadimplentes', compact('dados'));
    }

    public function PacientesRecibo()
    {
        // Buscar todos os registros onde o campo recibo é true e carregar o relacionamento paciente
        $dados = SessaoPaciente::select(
            'sessao_paciente.id_sp AS id',
            'pacientes.nome_paciente AS paciente',
            'sessao_paciente.dia_vencimento',
            'sessao_paciente.valor_sessao'
        )
            ->join('pacientes', 'sessao_paciente.paciente_id', '=', 'pacientes.id_paciente')
            ->where('recibo', true)
            ->orderBy('nome_paciente', 'asc')
            ->get();

        // Retornar a view com os dados dos pacientes que solicitam recibos
        return view('relatorios.pagamentos.pacientes_recibo', compact('dados'));
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
        $dados = GastosPessoais::whereMonth('data_pagamento', $mesAtual)
            ->whereYear('data_pagamento', $anoAtual)
            ->get();

        // Formatar a data_pagamento e vencimento para o formato "d/m/Y"
        $dados->transform(function ($item) {
            $item->data_vencimento = \Carbon\Carbon::parse($item->data_vencimento)->format('d/m/Y');
            $item->data_pagamento = \Carbon\Carbon::parse($item->data_pagamento)->format('d/m/Y');
            return $item;
        });

        // Exibir os resultados em uma view (ou gerar um PDF, se preferir)
        return view('relatorios.gastos_pessoais.gastos', compact('dados'));
    }

    public function GastosPessoaisPeriodo(Request $request)
    {
        $data = $request->all();
        $data_a = \Carbon\Carbon::parse($data['data_a'])->format('d/m/Y');
        $data_b = \Carbon\Carbon::parse($data['data_b'])->format('d/m/Y');

        // Buscar todos os gastos dentro do período especificado
        $dados = GastosPessoais::whereBetween('data_pagamento', [$data['data_a'], $data['data_b']])
            ->orderBy('data_pagamento', 'asc')
            ->get();

        // Formatar a data_pagamento e vencimento para o formato "d/m/Y"
        $dados->transform(function ($item) {
            $item->data_vencimento = \Carbon\Carbon::parse($item->data_vencimento)->format('d/m/Y');
            $item->data_pagamento = \Carbon\Carbon::parse($item->data_pagamento)->format('d/m/Y');
            return $item;
        });

        // Retornar a view com os dados dos gastos
        return view('relatorios.gastos_pessoais.gastos_periodo', compact('dados', 'data_a', 'data_b'));
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
        $dados = GastosProfissionais::whereMonth('data_pagamento', $mesAtual)
            ->whereYear('data_pagamento', $anoAtual)
            ->get();

        // Formatar a data_pagamento e vencimento para o formato "d/m/Y"
        $dados->transform(function ($item) {
            $item->data_vencimento = \Carbon\Carbon::parse($item->data_vencimento)->format('d/m/Y');
            $item->data_pagamento = \Carbon\Carbon::parse($item->data_pagamento)->format('d/m/Y');
            return $item;
        });

        // Exibir os resultados em uma view (ou gerar um PDF, se preferir)
        return view('relatorios.gastos_profissionais.gastos', compact('dados'));
    }

    public function GastosProfissionaisPeriodo(Request $request)
    {
        $data = $request->all();
        $data_a = \Carbon\Carbon::parse($data['data_a'])->format('d/m/Y');
        $data_b = \Carbon\Carbon::parse($data['data_b'])->format('d/m/Y');

        // Buscar todos os gastos dentro do período especificado
        $dados = GastosProfissionais::whereBetween('data_pagamento', [$data['data_a'], $data['data_b']])
        ->orderBy('data_pagamento', 'asc')
        ->get();

        // Formatar a data_pagamento e vencimento para o formato "d/m/Y"
        $dados->transform(function ($item) {
            $item->data_vencimento = \Carbon\Carbon::parse($item->data_vencimento)->format('d/m/Y');
            $item->data_pagamento = \Carbon\Carbon::parse($item->data_pagamento)->format('d/m/Y');
            return $item;
        });

        // Retornar a view com os dados dos gastos
        return view('relatorios.gastos_profissionais.gastos_periodo', compact('dados', 'data_a', 'data_b'));
    }
}
