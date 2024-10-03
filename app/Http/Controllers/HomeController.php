<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\Sessao;
use App\SessaoCancelada;
use App\ValidacaoAgendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $now = Carbon::now();
        $month = $now->month;
        $month = 5;
        $year = $now->year;

        $data = [];
        $data['total_pacientes'] = $this->contarPacientes();
        $data['total_validacoes'] = $this->contarValidacoesPendentes();
        $data['total_sessoes'] = $this->contarSessoes($month, $year);
        $data['total_valors'] = $this->somarValoresSessoes($month, $year);
        $data['chartP_sessoes'] = $this->getChartDataSessoes($month, $year);

        //dd($data['chartP_sessoes']);

        // Lista os anos
        $anos = $this->listarAnos();

        return view('index', compact('data', 'anos'));
    }

    public function indexMonthSelect(Request $request)
    {
        $dataR = $request->all();
        $month = $dataR['mes'];
        $year = $dataR['ano'];

        $data = [];
        $data['total_pacientes'] = $this->contarPacientes();
        $data['total_validacoes'] = $this->contarValidacoesPendentes();
        $data['total_sessoes'] = $this->contarSessoes($month, $year);
        $data['total_valors'] = $this->somarValoresSessoes($month, $year);

        // Lista os anos
        $anos = $this->listarAnos();

        return view('index', compact('data', 'anos'));
    }

    public function contarPacientes()
    {
        return Paciente::where('status', 'ativo')->count();
    }

    public function contarSessoes($month, $year)
    {
        return Sessao::whereYear('data_sessao', $year)
            ->whereMonth('data_sessao', $month)
            ->count();
    }

    public function somarValoresSessoes($month, $year)
    {
        return Sessao::whereYear('data_sessao', $year)
            ->whereMonth('data_sessao', $month)
            ->sum('valor_sessao');
    }

    public function contarValidacoesPendentes()
    {
        return ValidacaoAgendamento::count();
    }

    //Gráficos

    public function getChartDataSessoes($month, $year)
    {
        // Total de sessões que ocorreram no mês
        $totalSessoes = Sessao::whereMonth('data_sessao', $month)->whereYear('data_sessao', $year)->count();

        // Total de sessões canceladas no mês
        $totalSessoesCanceladas = SessaoCancelada::whereMonth('data_registro', $month)->whereYear('data_registro', $year)->count();

        // Retorna os dados como JSON
        return response()->json([
            'sessoes' => $totalSessoes,
            'sessoes_canceladas' => $totalSessoesCanceladas,
        ]);
    }

    public function listarAnos()
    {
        $anos = DB::table('sessao')
            ->select(DB::raw('EXTRACT(YEAR FROM data_sessao) as ano'))
            ->distinct()
            ->orderBy('ano', 'asc')
            ->pluck('ano');

        return $anos;
    }
}
