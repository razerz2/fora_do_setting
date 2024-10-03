<?php

namespace App\Http\Controllers;

use App\AgendamentoPeriodo;
use App\Http\Requests;
use App\Http\Requests\AgendamentoPeriodoRequest;
use Illuminate\Http\Request;

class AgendamentoPeriodoController extends Controller
{
    public function index()
    {
        $periodos = AgendamentoPeriodo::orderBy('id_ap', 'asc')->get();

        return view('configuracao.periodo.index', compact('periodos'));
    }

    public function edit($id)
    {
        $periodo = AgendamentoPeriodo::find($id);

        return view('configuracao.periodo.edit', compact('periodo'));
    }

    public function update(AgendamentoPeriodoRequest $request, $id)
    {
        try {

            $data = $request->all();
            $data['hora_inicial'] = \Carbon\Carbon::createFromFormat('H:i', $data['hora_inicial'])->format('H:i:s');
            $data['hora_final'] = \Carbon\Carbon::createFromFormat('H:i', $data['hora_final'])->format('H:i:s');
            $periodo = AgendamentoPeriodo::findOrFail($id);
            // Atualize os dados do período
            $periodo->fill($data);
            $periodo->save();

            return redirect()->route('Periodo.index')->with('success', 'Período atualizado com sucesso.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('Periodo.index')->with('error', 'Período não encontrado.');
        } catch (\Exception $e) {
            return redirect()->route('Periodo.index')->with('error', 'Erro ao atualizar o período: ' . $e->getMessage());
        }
    }
}
