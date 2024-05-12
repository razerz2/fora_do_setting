<?php

namespace App\Http\Controllers;

use App\Permissoes;
use App\Agendamento;
use App\AgendamentoPaciente;
use App\AgendamentoPeriodo;
use App\AgendamentoReservado;
use App\AgendamentoTipo;
use App\Paciente;
use App\Http\Requests;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Verifica a permissão de acesso antes de executar qualquer método do controller
        $this->middleware(function ($request, $next) {
            // Verifica se o usuário atual tem permissão para acessar a área
            if (!Permissoes::verificarPermissao(auth()->user(), 'agenda')) {
                // Se o usuário não tiver permissão, redireciona para a página inicial com uma mensagem de erro
                return redirect()->route('home')->with('error', 'Você não tem permissão para acessar a área solicitada.');
            }

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendamentos = Agendamento::with('agendamentoPeriodo.agendamento', 'agendamentoTipo.agendamento')
        ->orderBy('ap_id')
        ->orderBy('n_dia')
        ->orderBy('horario_inicial')
        ->get();

        $tipo_agendamentos = AgendamentoTipo::where('id_at', '!=', 2)->get();

        return view('agenda.index', compact('agendamentos', 'tipo_agendamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periodos = AgendamentoPeriodo::all();
    
        return view('agenda.create', compact('periodos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AgendamentosRequest $request)
{
    try {
        $data = $request->all();
        $data['at_id'] = 2;
        $data['dia'] = $this->nomeSemana($data['n_dia']);
        $data['data_registro'] = now()->setTimezone('America/Campo_Grande')->format('Y-m-d H:i:s');
        $recovery = Agendamento::create($data);

        return redirect()->route('Agendamento.index');
    } catch (\Exception $e) {
        \Log::error('Ocorreu um erro ao criar o agendamento: ' . $e->getMessage());
        return redirect()->route('Agendamento.index')->with('error', 'Ocorreu um erro ao criar o agendamento:'. $e->getMessage());
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agendamento = Agendamento::with('agendamentoPeriodo.agendamento', 'agendamentoTipo.agendamento')
            ->where('id_agendamento', $id)
            ->first();

        $agendamentosDetalhes = [];

        if ($agendamento->at_id == 1) {
            $agendamentosDetalhes = AgendamentoPaciente::leftJoin('pacientes', 'agendamento_paciente.paciente_id', '=', 'pacientes.id_paciente')
                ->where('agendamento_paciente.agendamento_id', $id)
                ->get();

            //dd($agendamentosDetalhes);    

            if ($agendamentosDetalhes->isEmpty()) {
                return redirect()->route('Agenda.index')->with('error', 'Detalhes do agendamento não encontrados.');
            }

            return view('agenda.show_ap', compact('agendamento', 'agendamentosDetalhes'));

        } elseif ($agendamento->at_id == 3) {
            $agendamentosDetalhes = AgendamentoReservado::leftJoin('agendamento', 'agendamento_reservado.agendamento_id', '=', 'agendamento.id_agendamento')
                ->where('agendamento_reservado.agendamento_id', $id)
                ->get();

            if ($agendamentosDetalhes->isEmpty()) {
                return redirect()->route('Agenda.index')->with('error', 'Detalhes do agendamento não encontrados.');
            }

            return view('agenda.show_ar', compact('agendamento', 'agendamentosDetalhes'));
        }

        return view('agenda.show', compact('agendamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agendamentoExcluir(Request $request)
    {
        try {
            $data = $request->all();

            $agendamento = Agendamento::find($data['id_agendamento']);

            if (!$agendamento) {
                return redirect()->route('Agendamento.index')->with('error', 'Agendamento Nº' . $data['id_agendamento'] . ' não encontrado!');
            }

            if ($agendamento->at_id == 1) {
                // Apagar na tabela agendamento paciente...
                AgendamentoPaciente::where('agendamento_id', $agendamento->id_agendamento)->delete();
            } elseif ($agendamento->at_id == 3) {
                // Apagar na tabela agendamento reservado...
                AgendamentoReservado::where('agendamento_id', $agendamento->id_agendamento)->delete();
            }

            $agendamento->delete();

            return redirect()->route('Agendamento.index');
        } catch (\Exception $e) {
            \Log::error('Ocorreu um erro ao excluir o agendamento: ' . $e->getMessage());
            return redirect()->route('Agendamento.index')->with('error', 'Ocorreu um erro ao excluir o agendamento:'. $e->getMessage());
        }
    }

    public function agenda()
    {
        // Definir os dias da semana e períodos
        $dias_semana = [1 => 'Segunda', 2 => 'Terça', 3 => 'Quarta', 4 => 'Quinta', 5 => 'Sexta', 6 => 'Sábado', 7 => 'Domingo'];
        $periodos = [1 => 'Manhã', 2 => 'Tarde', 3 => 'Noite'];

        // Recuperar os agendamentos do banco de dados (supondo que você tenha o modelo Agendamento configurado corretamente)
        $agendamentos = Agendamento::with('agendamentoPeriodo.agendamento', 'agendamentoTipo.agendamento', 'agendamentoPaciente.agendamento.')->get();
        //dd($agendamentos);
        // Inicializar um array vazio para armazenar os agendamentos por dia e período
        $calendario = [];

        // Organizar os agendamentos por dia e período
        foreach ($dias_semana as $n_dia => $dia) {
            foreach ($periodos as $ap_id => $periodo) {
                // Filtrar os agendamentos para o dia e período atual
                // Filtrar os agendamentos para o dia, período
                $agendamentos_dia_periodo = $agendamentos->where('n_dia', $n_dia)
                    ->where('ap_id', $ap_id);

                // Ordenar os agendamentos pelo horário inicial
                $agendamentos_dia_periodo_sorted = $agendamentos_dia_periodo->sortBy('horario_inicial');

                // Armazenar os agendamentos no calendário
                $calendario[$periodo][$dia] = $agendamentos_dia_periodo_sorted;
            }
        }

        //dd($calendario);

        // Passar as variáveis para a view
        return view('Agenda.agendamento', compact('dias_semana', 'periodos', 'calendario'));
    }

    public function getAgendamento($id)
    {
        $agendamento = Agendamento::with('agendamentoPeriodo.agendamento', 'agendamentoTipo.agendamento')
            ->where('id_agendamento', $id)
            ->first();

        $agendamentosDetalhes = [];

        if ($agendamento->at_id == 1) {
            $agendamentosDetalhes = AgendamentoPaciente::leftJoin('pacientes', 'agendamento_paciente.paciente_id', '=', 'pacientes.id_paciente')
                ->where('agendamento_paciente.agendamento_id', $id)
                ->get();

            if ($agendamentosDetalhes->isEmpty()) {
                return response()->json(['message' => 'Detalhes do agendamento não encontrados'], 404);
            }
        } elseif ($agendamento->at_id == 3) {
            $agendamentosDetalhes = AgendamentoReservado::leftJoin('agendamento', 'agendamento_reservado.agendamento_id', '=', 'agendamento.id_agendamento')
                ->where('agendamento_reservado.agendamento_id', $id)
                ->get();

            if ($agendamentosDetalhes->isEmpty()) {
                return response()->json(['message' => 'Detalhes do agendamento não encontrados'], 404);
            }
        }

        return response()->json([
            'data' => [
                'agendamento' => $agendamento,
                'agendamento_detalhes' => $agendamentosDetalhes
            ]
        ]);
    }

    public function agendamentoRedirecionador(Request $request)
    {
        $tipo_agendamento = $request->at_id;
        $agendamento = Agendamento::with('agendamentoPeriodo.agendamento', 'agendamentoTipo.agendamento')
        ->where('id_agendamento', $request->id_agendamento)
        ->first();

        if($tipo_agendamento  == 1){
           $pacientes = Paciente::orderBy('nome_paciente', 'asc')->get();
           return view('agenda.create_ap', compact('tipo_agendamento', 'agendamento', 'pacientes'));
        }else if($tipo_agendamento  == 3){
           return view('agenda.create_ar', compact('tipo_agendamento', 'agendamento'));
        }

        return false;
    }

    public function agendamentoDesmarcar(Request $request)
    {
        try {
            $data = $request->all();

            $agendamento = Agendamento::find($data['id_agendamento']);

            if (!$agendamento) {
                return redirect()->route('Agendamento.index')->with('error', 'Agendamento Nº' . $data['id_agendamento'] . ' não encontrado!');
            }

            if ($agendamento->at_id == 1) {
                //apagar na tabela agendamento paciente...
                AgendamentoPaciente::where('agendamento_id', $agendamento->id_agendamento)->delete();
                $this->alterarAgendamentoLivre($agendamento->id_agendamento);
            } elseif ($agendamento->at_id == 3) {
                //apagar na tabela agendamento reservado...
                AgendamentoReservado::where('agendamento_id', $agendamento->id_agendamento)->delete();
                $this->alterarAgendamentoLivre($agendamento->id_agendamento);
            }

            return redirect()->route('Agendamento.index');
        } catch (\Exception $e) {
            \Log::error('Ocorreu um erro ao desmarcar o agendamento:: ' . $e->getMessage());
            return redirect()->route('Agendamento.index')->with('error', 'Ocorreu um erro ao desmarcar o agendamento: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAgendamentoPaciente(Request $request)
    {
        try {
            $data = $request->all();
            if (array_key_exists('presencial', $data)) {
                $data['presencial'] = true;
            } else {
                $data['presencial'] = false;
            }
            $this->alterarStatusAgendamento($data['agendamento_id'], $data['at_id']);
            $recovery = AgendamentoPaciente::create($data);

            return redirect()->route('Agendamento.index');
        } catch (\Exception $e) {
            \Log::error('Erro ao registrar Agendamento: ' . $e->getMessage());
            return redirect()->route('Agendamento.index')->with('error', 'Ocorreu um erro ao salvar o agendamento: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAgendamentoReservado(Request $request)
    {
        try {
            $data = $request->all();
            if (array_key_exists('presencial', $data)) {
                $data['presencial'] = true;
            } else {
                $data['presencial'] = false;
            }
            $this->alterarStatusAgendamento($data['agendamento_id'], $data['at_id']);
            $recovery = AgendamentoReservado::create($data);

            return redirect()->route('Agendamento.index');
        } catch (\Exception $e) {
            \Log::error('Erro ao registrar Agendamento: ' . $e->getMessage());
            return redirect()->route('Agendamento.index')->with('error', 'Ocorreu um erro ao salvar o agendamento: ' . $e->getMessage());
        }
    }

    public function alterarStatusAgendamento($id, $status)
{
    try {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->at_id = $status;
        $agendamento->save();
        return true;
    } catch (\Exception $e) {
        \Log::error('Erro ao registrar Agendamento: ' . $e->getMessage());
        return false;
    }
}

    public function alterarAgendamentoLivre($id)
    {
        try {
            $agendamento = Agendamento::find($id); // Suponha que $id seja o id do agendamento que você deseja atualizar
            $agendamento->at_id = 2;
            $agendamento->save();
            return true;
        } catch (\Exception $e) {
            \Log::error('Erro ao registrar Agendamento: ' . $e->getMessage());
            return false;
        }
    }
    
    public function nomeSemana($dia)
    {
        $dias_semana = [1 => 'Segunda', 2 => 'Terça', 3 => 'Quarta', 4 => 'Quinta', 5 => 'Sexta', 6 => 'Sábado', 7 => 'Domingo'];

        return $dias_semana[$dia];
    }
}
