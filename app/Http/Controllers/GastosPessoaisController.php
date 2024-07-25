<?php

namespace App\Http\Controllers;

use App\Permissoes;
use App\GastosPessoais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GastosPessoaisController extends Controller
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
            if (!Permissoes::verificarPermissao(auth()->user(), 'gastos_pessoais')) {
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
        $gastos = GastosPessoais::all();

       return view('gastos_pessoais.index', compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gastos_pessoais.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['valor_despesa'] = $this->converterParaFloat($data['valor_despesa']);
            $data = $this->tratarRecursivo($data, $request);

            $recovery = GastosPessoais::create($data);

            DB::commit();

            return redirect()->route('GastosPessoais.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('GastosPessoais.index')->with('error', 'Ocorreu um erro ao salvar os dados: ' . $e->getMessage());
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
        $gasto = GastosPessoais::find($id);

        return view('gastos_pessoais.show', compact('gasto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gasto = GastosPessoais::find($id);

        return view('gastos_pessoais.edit', compact('gasto'));
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
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['valor_despesa'] = $this->converterParaFloat($data['valor_despesa']);
            $data = $this->tratarRecursivo($data, $request);

            // Encontre o registro pelo ID
            $gasto = GastosPessoais::findOrFail($id);

            // Atualize os dados do registro
            $gasto->fill($data);
            $gasto->save();

            DB::commit();

            return redirect()->route('GastosPessoais.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('GastosPessoais.index')->with('error', 'Ocorreu um erro ao atualizar os dados: ' . $e->getMessage());
        }
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
        DB::beginTransaction();

        try {
            $id_gpe = $request->id_gpe;

            // Remover a validação do agendamento
            GastosPessoais::where('id_gpe', $id_gpe)->delete();

            DB::commit();

            return redirect()->route('GastosPessoais.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('GastosPessoais.index')->with('error', 'Ocorreu um erro ao excluir os dados: ' . $e->getMessage());
        }
    }

    public function tratarRecursivo($data, $request)
    {
        if ($request->has('recursivo')) { 
            $data['recursivo'] = TRUE;
            $dataVencimento = $request->input('data_vencimento');
            $data['dia_vencimento'] = Carbon::parse($dataVencimento)->day;
        } else {
            $data['recursivo'] = FALSE;
            $data['dia_vencimento'] = 0;
        }
      
        return $data;
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
