<?php

namespace App\Http\Controllers;

use App\Permissoes;
use App\SessaoCancelada;
use Illuminate\Http\Request;

class SessaoCanceladaController extends Controller
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
        $sessoes = SessaoCancelada::join('agendamento', 'sessao_cancelada.agendamento_id', '=', 'agendamento.id_agendamento')
        ->join('pacientes', 'sessao_cancelada.paciente_id', '=', 'pacientes.id_paciente')
        ->join('validacao_motivo', 'sessao_cancelada.vm_id', '=', 'validacao_motivo.id_vm')
        ->leftjoin('agendamento_periodo', 'agendamento.ap_id', '=', 'agendamento_periodo.id_ap')
        ->leftjoin('agendamento_tipo', 'agendamento.at_id', '=', 'agendamento_tipo.id_at')
        ->select('sessao_cancelada.*', 'agendamento.*', 'agendamento_periodo.*', 'agendamento_tipo.*', 'pacientes.*', 'validacao_motivo.*')
        ->get();

        return view('sessao_cancelados.index', compact('sessoes'));
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
        $sessao = SessaoCancelada::join('agendamento', 'sessao_cancelada.agendamento_id', '=', 'agendamento.id_agendamento')
        ->join('pacientes', 'sessao_cancelada.paciente_id', '=', 'pacientes.id_paciente')
        ->join('validacao_motivo', 'sessao_cancelada.vm_id', '=', 'validacao_motivo.id_vm')
        ->leftjoin('agendamento_periodo', 'agendamento.ap_id', '=', 'agendamento_periodo.id_ap')
        ->where('sessao_cancelada.id_sc', $id)
        ->select('sessao_cancelada.*','agendamento.*','agendamento_periodo.*','pacientes.*', 'validacao_motivo.*')
        ->firstOrFail(); // Lança uma exceção se não encontrar

        //dd($sessao);

        return view ('sessao_cancelados.show',compact('sessao'));
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
}
