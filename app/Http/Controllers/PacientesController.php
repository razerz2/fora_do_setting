<?php

namespace App\Http\Controllers;

use App\Permissoes;
use App\Paciente;
use App\Inativacao;
use App\MotivoInativacao;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PacientesController extends Controller
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
            if (!Permissoes::verificarPermissao(auth()->user(), 'pacientes')) {
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
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\PacienteRequest $request)
    {
        try {
            $data = $request->all();
            
            $image = $request->file('InputFile');     
            $data['status'] = 'ativo';
            $recovery = Paciente::create($data);

            $this->salvaImagemPerfil($image, $recovery->id_paciente);
    
            return redirect()->route('Pacientes.index');

        } catch (\Exception $e) {
            // Em caso de erro, trate a exceção aqui
            // Por exemplo, você pode registrar o erro, lançar uma nova exceção ou retornar false
            \Log::error('Erro ao registrar Paciente: ' . $e->getMessage());
            return redirect()->route('Pacientes.index')->with('error', 'Erro ao registrar Paciente, contate o suporte!');
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
        $paciente = Paciente::with('enderecoP.pais', 'enderecoP.estado', 'enderecoP.cidade')->find($id);

        //dd($paciente);
        
        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::find($id);
        
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\PacienteRequest $request, $id)
    {
        try {
            $data = $request->all();
    
            // Encontre o paciente pelo ID
            $paciente = Paciente::findOrFail($id);
    
            // Atualize os dados do paciente
            $paciente->fill($data);
            $paciente->save();
    
            return redirect()->route('Pacientes.index');
        } catch (ModelNotFoundException $e) {
            // Se o paciente não for encontrado
            return redirect()->route('Pacientes.index')->with('error', 'Paciente não encontrado.');
        } catch (\Exception $e) {
            // Se ocorrer uma exceção desconhecida
            \Log::error('Erro ao alterar dados do Paciente: ' . $e->getMessage());
            return redirect()->route('Pacientes.index')->with('error',  'Ocorreu um erro ao atualizar o paciente, contate o suporte!');
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

    public function salvaImagemPerfil($image, $id_user)
    {
        // Verifica se existe um arquivo de imagem no pedido
        if ($image) {

            if ($image->isValid() && $image->getClientOriginalExtension()) {
                $customName = 'pct' . $id_user . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('images/pacientes/', $customName, 'public');
            }
        } else {
            // Se nenhum arquivo de imagem for carregado, copie a imagem padrão
            $defaultImagePath = public_path('img/user-default.jpg'); // Caminho para a imagem padrão
            $customName = 'pct' . $id_user . '.jpg'; // Nome para a imagem padrão

            // Copie a imagem padrão para o sistema de armazenamento
            Storage::disk('public')->put('images/pacientes/' . $customName, file_get_contents($defaultImagePath));


            // Você pode salvar o caminho da imagem padrão no banco de dados se necessário
        }
    }

    public function alterarImagemPerfil($image, $id_user)
    {

        if ($image) {

            if ($image->isValid() && $image->getClientOriginalExtension()) {

                $customName = 'pct' . $id_user . '.' . $image->getClientOriginalExtension();
                $path = 'images/pacientes/' . $customName;
                Storage::disk('public')->delete($path);
                $path = $image->storeAs('images/pacientes/', $customName, 'public');

                //return dd($path);
            }
        }
    }

    public function desativar(Request $request)
    {
        try {
            $id = $request->paciente_id;
            $data = $request->all();
    
            // Encontre o paciente pelo ID
            $paciente = Paciente::findOrFail($id);
    
            // Atualize o status do paciente para 'inativo'
            $data['status'] = 'inativo';
            $paciente->fill($data);
            $paciente->save();
    
            // Crie um registro de inativação
            Inativacao::create($data);
    
            return redirect()->route('Pacientes.index');
        } catch (ModelNotFoundException $e) {
            // Se o paciente não for encontrado
            return redirect()->route('Pacientes.index')->with('error',  'Paciente não encontrado.');
        } catch (\Exception $e) {
            // Se ocorrer uma exceção desconhecida
            \Log::error('Ocorreu um erro ao desativar o paciente: ' . $e->getMessage());
            return redirect()->route('Pacientes.index')->with('error',  'Ocorreu um erro ao desativar o paciente, contate o suporte!');
        }
    }

    public function desativarView($id)
    {

        $paciente = Paciente::find($id);
        $motivos = MotivoInativacao::all();

        return view('pacientes.disable', compact('paciente', 'motivos'));
    }

    public function ativar(Request $request)
    {
        try {
            $id = $request->id_usuario;
            $data = $request->all();
    
            // Encontre o paciente pelo ID
            $paciente = Paciente::findOrFail($id);
    
            // Atualize o status do paciente para 'ativo'
            $data['status'] = 'ativo';
            $paciente->fill($data);
            $paciente->save();
    
            // Exclua o registro de inativação associado ao paciente
            Inativacao::where('paciente_id', $id)->delete();
    
            return redirect()->route('Pacientes.index');
        } catch (ModelNotFoundException $e) {
            // Se o paciente não for encontrado
            return redirect()->route('Pacientes.index')->with('error', 'Paciente não encontrado.');
        } catch (Exception $e) {
            // Se ocorrer uma exceção desconhecida
            \Log::error('Ocorreu um erro ao ativar o paciente: ' . $e->getMessage());
            return redirect()->route('Pacientes.index')->with('error',  'Ocorreu um erro ao ativar o paciente, contate o suporte!');
        }
    }

}
