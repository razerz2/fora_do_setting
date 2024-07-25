<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\Sessao;
use App\ValidacaoAgendamento;
use Illuminate\Http\Request;
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
        $data = [];
        $data['total_pacientes'] = $this->contarPacientes();
        $data['total_sessoes'] = $this->contarSessoes();
        $data['total_valors'] = $this->somarValoresSessoes();
        $data['total_validacoes'] = $this->contarValidacoesPendentes();

        return view('index', compact('data'));
    }

    public function contarPacientes()
    {
        return Paciente::where('status', 'ativo')->count();
    }

    public function contarSessoes()
    {
        $now = Carbon::now();
        return Sessao::whereYear('data_sessao', $now->year)
            ->whereMonth('data_sessao', $now->month)
            ->count();
    }

    public function somarValoresSessoes()
    {
        $now = Carbon::now();
        return Sessao::whereYear('data_sessao', $now->year)
            ->whereMonth('data_sessao', $now->month)
            ->sum('valor_sessao');
    }

    public function contarValidacoesPendentes()
    {
        return ValidacaoAgendamento::count();
    }
}
