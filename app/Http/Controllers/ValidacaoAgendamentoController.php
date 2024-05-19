<?php

namespace App\Http\Controllers;

use App\Permissoes;
use App\ValidacaoAgendamento;
use App\ValidacaoMotivo;
use Illuminate\Http\Request;

class ValidacaoAgendamentoController extends Controller
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
            if (!Permissoes::verificarPermissao(auth()->user(), 'sessoes')) {
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
        $agendamentos = ValidacaoAgendamento::join('agendamento', 'validacao_agendamento.agendamento_id', '=', 'agendamento.id_agendamento')
        ->join('agendamento_paciente', 'agendamento.id_agendamento', '=', 'agendamento_paciente.agendamento_id')
        ->join('pacientes', 'agendamento_paciente.paciente_id', '=', 'pacientes.id_paciente')
        ->where('validacao_agendamento.status', false)
        ->orderBy('validacao_agendamento.data_registro', 'asc')
        ->select('validacao_agendamento.*', 'agendamento.*', 'agendamento_paciente.*', 'pacientes.*')
        ->get();

        $motivos_validacao = ValidacaoMotivo::all();

        return view('validacao.index', compact('agendamentos', 'motivos_validacao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function validar(Request $request)
    {
        echo "Validar";
    }

    public function invalidar(Request $request)
    {
        echo "Invalidar";
    }
}
