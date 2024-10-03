<?php

namespace App\Http\Controllers;

use App\MotivoInativacao;
use App\Permissoes;
use App\LogsUser;
use App\Http\Requests\MotivoInativacaoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MotivoInativacaoController extends Controller
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
            if (!Permissoes::verificarPermissao(auth()->user(), 'sistema')) {
                // Se o usuário não tiver permissão, redireciona para a página inicial com uma mensagem de erro
                return redirect()->route('home')->with('error', 'Você não tem permissão para acessar a área solicitada.');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $motivos = MotivoInativacao::all();

        return view('configuracao.motivo_inativacao.index', compact('motivos'));
    }

    public function store(MotivoInativacaoRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['registro_sistemico'] = false;
            $recovery = MotivoInativacao::create($data);

            DB::commit();

            $this->logRegister('MotivoInativacao', 'store', $recovery);
            return redirect()->route('MotivoInativacao.index');
        } catch (\Exception $e) {
            DB::rollBack();
            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('MotivoInativacao.index')->with('error', 'Ocorreu um erro ao inserir os dados: ' . $e->getMessage());
        }
    }

    public function update(MotivoInativacaoRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $id = $data['id_mi'];
            $motivo = MotivoInativacao::find($id);
            $motivo->fill($data);
            $motivo->save();

            DB::commit();

            $this->logRegister('MotivoInativacao', 'update', $motivo);
            return redirect()->route('MotivoInativacao.index');
        } catch (\Exception $e) {
            DB::rollBack();
            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('MotivoInativacao.index')->with('error', 'Ocorreu um erro ao atualizar os dados: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        // Inicia a transação
        DB::beginTransaction();

        try {
            $data = $request->all();
            $id = $data['id_mi'];

            // Encontra o registro pelo ID
            $motivo = MotivoInativacao::find($id);

            // Verifica se o registro existe
            if (!$motivo) {
                // Realiza o rollback se o registro não for encontrado
                DB::rollBack();
                return redirect()->route('MotivoInativacao.index')->with('error', 'Registro não encontrado.');
            }

            // Verifica se o campo 'registro_sistemico' é true (não pode ser excluído)
            if ($motivo->registro_sistemico) {
                // Realiza o rollback se o registro for sistêmico
                DB::rollBack();
                return redirect()->route('MotivoInativacao.index')->with('error', 'Este registro é sistêmico e não pode ser excluído.');
            }

            // Se o registro não for sistêmico, realiza a exclusão
            $motivo->delete();

            // Log de exclusão (ajustado com transação aberta)
            $this->logRegister('MotivoInativacao', 'delete', $motivo);

            // Confirma a transação
            DB::commit();

            return redirect()->route('MotivoInativacao.index')->with('success', 'Registro excluído com sucesso.');
        } catch (\Exception $e) {
            // Realiza o rollback em caso de erro
            DB::rollBack();
            return redirect()->route('MotivoInativacao.index')->with('error', 'Erro ao tentar excluir o registro: ' . $e->getMessage());
        }
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
