<?php

namespace App\Http\Controllers;

use App\Permissoes;
use App\GastosProfissionais;
use App\LogsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GastosProfissionaisController extends Controller
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
            if (!Permissoes::verificarPermissao(auth()->user(), 'gastos_profissionais')) {
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
       $gastos = GastosProfissionais::all();

       return view('gastos_profissionais.index', compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gastos_profissionais.create');
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

            $recovery = GastosProfissionais::create($data);

            DB::commit();
            
            $this->logRegister('GastosProfissionais', 'store', $recovery);
            return redirect()->route('GastosProfissionais.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('GastosProfissionais.index')->with('error', 'Ocorreu um erro ao salvar os dados: ' . $e->getMessage());
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
        $gasto = GastosProfissionais::find($id);

        return view('gastos_profissionais.show', compact('gasto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gasto = GastosProfissionais::find($id);

        return view('gastos_profissionais.edit', compact('gasto'));
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
            $gasto = GastosProfissionais::findOrFail($id);

            // Atualize os dados do registro
            $gasto->fill($data);
            $gasto->save();

            DB::commit();
            
            $this->logRegister('GastosProfissionais', 'update', $gasto);
            return redirect()->route('GastosProfissionais.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('GastosProfissionais.index')->with('error', 'Ocorreu um erro ao atualizar os dados: ' . $e->getMessage());
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
            $id_gpr = $request->id_gpr;

            // Remover a validação do agendamento
            $gasto = GastosProfissionais::where('id_gpr', $id_gpr)->delete();

            DB::commit();
            
            $this->logRegister('GastosProfissionais', 'destroy', $gasto);
            return redirect()->route('GastosProfissionais.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('GastosProfissionais.index')->with('error', 'Ocorreu um erro ao excluir os dados: ' . $e->getMessage());
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

    public function logRegister($route, $action, $content)
    {
        LogsUser::create([
            'user_id' => Auth::id(),
            'route' => $route,
            'action' => $action,
            'content' => json_encode($content), 
            'data_registro' => now()
        ]);
    }

}
