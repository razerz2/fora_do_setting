<?php

namespace App\Http\Controllers;

use App\Paciente;
use App\Sessao;
use App\SessaoHistoricoReajuste;
use App\SessaoPaciente;
use Illuminate\Http\Request;

class SessaoPacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sessoes_paciente = SessaoPaciente::join('pacientes', 'sessao_paciente.paciente_id', '=', 'pacientes.id_paciente')
        ->orderBy('sessao_paciente.data_registro', 'asc')
        ->select('sessao_paciente.*', 'pacientes.nome_paciente')
        ->get();

        return view('sessao_paciente.index', compact('sessoes_paciente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::leftJoin('sessao_paciente', 'pacientes.id_paciente', '=', 'sessao_paciente.paciente_id')
        ->whereNull('sessao_paciente.paciente_id')
        ->select('pacientes.*')
        ->get();

        return view('sessao_paciente.create', compact('pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['valor_sessao'] = $this->converterParaFloat($data['valor_sessao']);
        $data['data_registro'] = now();
        
        SessaoPaciente::create($data);

        return redirect()->route('SessaoPaciente.index');
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
        $sessao_paciente = SessaoPaciente::find($id);
        $paciente = Paciente::find($sessao_paciente->paciente_id);

        return view('sessao_paciente.edit', compact('sessao_paciente', 'paciente'));
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
        $data = $request->all();
        $data['valor_sessao'] = $this->converterParaFloat($data['valor_sessao']);
        $this->storeHistoricoPaciente($data);
        $sessao_paciente = SessaoPaciente::findOrFail($id);
        $sessao_paciente->fill($data);
        $sessao_paciente->save();

        return redirect()->route('SessaoPaciente.index');
    }

    public function storeHistoricoPaciente($data)
    {
         $data_history['sp_id'] = $data['id_sp'];
         $data_history['paciente_id'] = $data['paciente_id'];
         $data_history['dia_vencimento'] = $data['dia_vencimento'];
         $data_history['valor'] = $data['valor_sessao'];
         $data_history['data_reajuste'] = now(); 

         SessaoHistoricoReajuste::create($data_history);

        return true;        
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
        $data = $request->all();
        SessaoHistoricoReajuste::where('sp_id', $data['id_sp'])->delete();
        SessaoPaciente::where('id_sp', $data['id_sp'])->delete();

        return redirect()->route('SessaoPaciente.index');
    }

    function converterParaFloat($valor)
    {
        // Remove todos os caracteres que não são dígitos, ponto ou vírgula
        $valor_limpo = preg_replace("/[^\d.,]/", "", $valor);

        // Substitui a vírgula por ponto (para o formato correto)
        $valor_limpo = str_replace(',', '.', $valor_limpo);

        // Remove todos os pontos, exceto o último
        $valor_limpo = preg_replace('/\.(?=.*\.)/', '', $valor_limpo);

        // Converte para float
        return floatval($valor_limpo);
    }
}
