<?php

namespace App\Http\Controllers;

use App\Sessao;
use Illuminate\Http\Request;

class SessaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessoes = Sessao::join('agendamento', 'sessao.agendamento_id', '=', 'agendamento.id_agendamento')
        ->join('pacientes', 'sessao.paciente_id', '=', 'pacientes.id_paciente')
        ->leftjoin('agendamento_periodo', 'agendamento.ap_id', '=', 'agendamento_periodo.id_ap')
        ->leftjoin('agendamento_tipo', 'agendamento.at_id', '=', 'agendamento_tipo.id_at')
        ->select('sessao.*', 'agendamento.*', 'agendamento_periodo.*', 'agendamento_tipo.*', 'pacientes.*')
        ->get();

        return view('sessao.index', compact('sessoes'));
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
        $sessao = Sessao::join('agendamento', 'sessao.agendamento_id', '=', 'agendamento.id_agendamento')
        ->join('pacientes', 'sessao.paciente_id', '=', 'pacientes.id_paciente')
        ->leftjoin('agendamento_periodo', 'agendamento.ap_id', '=', 'agendamento_periodo.id_ap')
        ->where('sessao.id_sessao', $id)
        ->select('sessao.*','agendamento.*','agendamento_periodo.*','pacientes.*')
        ->firstOrFail(); // Lança uma exceção se não encontrar

        //dd($sessao);

        return view ('sessao.show',compact('sessao'));
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

    public function excluir(Request $request)
    {
        $id_sessao = $request->id_sessao;

        // Remover a validação do agendamento
        Sessao::where('id_sessao', $id_sessao)->delete();

        return redirect()->route('Sessao.index');
    }
}
