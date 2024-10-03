<?php

namespace App\Http\Controllers;

Use App\Cidades;
Use App\Estados;
Use App\Paises;
Use App\Permissoes;
Use App\LogsUser;
use Illuminate\Http\Request;
use App\Http\Requests\LocaisCidadesRequest;
use App\Http\Requests\LocaisEstadosRequest;
use App\Http\Requests\LocaisPaisesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LocaisController extends Controller
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
         return view('configuracao.locais.index');
    }

    public function indexPaises()
    {
        $paises = Paises::all();

        return view('configuracao.locais.paises.index', compact('paises'));
    }

    public function indexEstados()
    {
        $paises = Paises::all();
        $estados = Estados::with('pais')->get();

        return view('configuracao.locais.estados.index', compact('estados', 'paises'));
    }

    public function indexCidades()
    {
        $paises = Paises::all();
        $cidades = Cidades::with(['estado.pais'])->get();
        
        return view('configuracao.locais.cidades.index', compact('cidades', 'paises'));
    }

    public function storePaises(LocaisPaisesRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $recovery = Paises::create($data);

            DB::commit();

            $this->logRegister('LocaisPaises', 'store', $recovery);
            return redirect()->route('LocaisPaises.index');
        } catch (\Exception $e) {
            DB::rollBack();
            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('LocaisPaises.index')->with('error', 'Ocorreu um erro ao inserir os dados: ' . $e->getMessage());
        }
    }

    public function storeEstados(LocaisEstadosRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $recovery = Estados::create($data);

            DB::commit();

            $this->logRegister('LocaisEstados', 'store', $recovery);
            return redirect()->route('LocaisEstados.index');
        } catch (\Exception $e) {
            DB::rollBack();
            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('LocaisEstados.index')->with('error', 'Ocorreu um erro ao inserir os dados: ' . $e->getMessage());
        }
    }

    public function storeCidades(LocaisCidadesRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $estado = Estados::find($data['estado_id']);
            $data['uf'] = $estado->uf;
            $recovery = Cidades::create($data);
            DB::commit();

            $this->logRegister('LocaisCidades', 'store', $recovery);
            return redirect()->route('LocaisCidades.index');
        } catch (\Exception $e) {
            DB::rollBack();
            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('LocaisCidades.index')->with('error', 'Ocorreu um erro ao inserir os dados: ' . $e->getMessage());
        }
    }

    public function updatePaises(LocaisPaisesRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $id = $data['id_pais'];
            $pais = Paises::find($id);
            $pais->fill($data);
            $pais->save();

            DB::commit();

            $this->logRegister('LocaisPaises', 'update', $pais);
            return redirect()->route('LocaisPaises.index');
        } catch (\Exception $e) {
            DB::rollBack();
            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('LocaisPaises.index')->with('error', 'Ocorreu um erro ao atualizar os dados: ' . $e->getMessage());
        }
    }

    public function updateEstados(LocaisEstadosRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $id = $data['id_estado'];
            $estado = Paises::find($id);
            $estado->fill($data);
            $estado->save();

            DB::commit();

            $this->logRegister('LocaisEstados', 'update', $estado);
            return redirect()->route('LocaisEstados.index');
        } catch (\Exception $e) {
            DB::rollBack();
            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('LocaisEstados.index')->with('error', 'Ocorreu um erro ao atualizar os dados: ' . $e->getMessage());
        }
    }

    public function updateCidades(LocaisCidadesRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();
            $estado = Estados::find($data['estado_id']);
            $data['uf'] = $estado->uf;
            $id = $data['id_cidade'];
            $cidade = Cidades::find($id);
            $cidade->fill($data);
            $cidade->save();

            DB::commit();

            $this->logRegister('LocaisCidades', 'update', $cidade);
            return redirect()->route('LocaisCidades.index');
        } catch (\Exception $e) {
            DB::rollBack();
            // Você pode personalizar a mensagem de erro e redirecionar para uma página específica, se desejar
            return redirect()->route('LocaisCidades.index')->with('error', 'Ocorreu um erro ao atualizar os dados: ' . $e->getMessage());
        }
    }

    public function destroyPaises(Request $request)
    {
        // Inicia a transação
        DB::beginTransaction();

        try {
            $data = $request->all();
            $id = $data['id_pais'];

            // Encontra o registro pelo ID
            $pais = Paises::find($id);

            // Verifica se o registro existe
            if (!$pais) {
                // Realiza o rollback se o registro não for encontrado
                DB::rollBack();
                return redirect()->route('LocaisPaises.index')->with('error', 'Registro não encontrado.');
            }

            // Se o registro não for sistêmico, realiza a exclusão
            $pais->delete();

            // Log de exclusão (ajustado com transação aberta)
            $this->logRegister('LocaisPaises', 'delete', $pais);

            // Confirma a transação
            DB::commit();

            return redirect()->route('LocaisPaises.index')->with('success', 'Registro excluído com sucesso.');
        } catch (\Exception $e) {
            // Realiza o rollback em caso de erro
            DB::rollBack();
            return redirect()->route('LocaisPaises.index')->with('error', 'Erro ao tentar excluir o registro: ' . $e->getMessage());
        }
    }

    public function destroyEstados(Request $request)
    {
        // Inicia a transação
        DB::beginTransaction();

        try {
            $data = $request->all();
            $id = $data['id_estado'];

            // Encontra o registro pelo ID
            $estado = Estados::find($id);

            // Verifica se o registro existe
            if (!$estado) {
                // Realiza o rollback se o registro não for encontrado
                DB::rollBack();
                return redirect()->route('LocaisEstados.index')->with('error', 'Registro não encontrado.');
            }

            // Se o registro não for sistêmico, realiza a exclusão
            $estado->delete();

            // Log de exclusão (ajustado com transação aberta)
            $this->logRegister('LocaisEstados', 'delete', $estado);

            // Confirma a transação
            DB::commit();

            return redirect()->route('LocaisEstados.index')->with('success', 'Registro excluído com sucesso.');
        } catch (\Exception $e) {
            // Realiza o rollback em caso de erro
            DB::rollBack();
            return redirect()->route('LocaisEstados.index')->with('error', 'Erro ao tentar excluir o registro: ' . $e->getMessage());
        }
    }

    public function destroyCidades(Request $request)
    {
         // Inicia a transação
        DB::beginTransaction();

        try {
            $data = $request->all();
            $id = $data['id_cidade'];

            // Encontra o registro pelo ID
            $cidade = Cidades::find($id);

            // Verifica se o registro existe
            if (!$cidade) {
                // Realiza o rollback se o registro não for encontrado
                DB::rollBack();
                return redirect()->route('LocaisCidades.index')->with('error', 'Registro não encontrado.');
            }

            // Se o registro não for sistêmico, realiza a exclusão
            $cidade->delete();

            // Log de exclusão (ajustado com transação aberta)
            $this->logRegister('LocaisCidades', 'delete', $cidade);

            // Confirma a transação
            DB::commit();

            return redirect()->route('LocaisCidades.index')->with('success', 'Registro excluído com sucesso.');
        } catch (\Exception $e) {
            // Realiza o rollback em caso de erro
            DB::rollBack();
            return redirect()->route('LocaisCidades.index')->with('error', 'Erro ao tentar excluir o registro: ' . $e->getMessage());
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
