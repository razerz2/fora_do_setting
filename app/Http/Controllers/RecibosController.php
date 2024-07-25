<?php

namespace App\Http\Controllers;


use App\Pagamentos;
use App\PagamentosSessoes;
use App\Paciente;
use App\PacienteEndereco;
use App\Sessao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecibosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = [];
        $data['pagamento'] = Pagamentos::find($id);
        $data['paciente'] = Paciente::with('enderecoP.pais', 'enderecoP.estado', 'enderecoP.cidade')->find($data['pagamento']->paciente_id);
        $data['sessoes'] = $this->listarPagamentoSessoes($id);
        $data['vt_pagamento'] = $this->valorTotalPagamento($id);

        //dd($data);
    
        return view("pagamentos.recibo", compact('data'));
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

    public function listarPagamentoSessoes($id_pagamento)
    {
        $sessoes = PagamentosSessoes::join('sessao', 'pagamentos_sessoes.sessao_id', '=', 'sessao.id_sessao')
            ->join('agendamento', 'sessao.agendamento_id', '=', 'agendamento.id_agendamento')
            ->join('agendamento_periodo', 'agendamento.ap_id', '=', 'agendamento_periodo.id_ap')
            ->join('agendamento_paciente', 'agendamento.id_agendamento', '=', 'agendamento_paciente.agendamento_id')
            ->where('pagamento_id', $id_pagamento)
            ->select('pagamentos_sessoes.*', 'sessao.*', 'agendamento.*', 'agendamento_periodo.*', 'agendamento_paciente.*')
            ->get();

        return $sessoes;
    }

    public function valorTotalPagamento($id_pagamento)
    {
        
        $totalValorSessoes = DB::table('pagamentos_sessoes')
            ->where('pagamento_id', $id_pagamento)
            ->sum('valor');

        return $totalValorSessoes;
    }
}
