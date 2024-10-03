<?php

namespace App\Http\Controllers;

use App\Paises;
use App\Estados;
use App\Cidades;
use App\Paciente;
use App\PacienteEndereco;
use App\LogsUser;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PacientesEnderecoController extends Controller
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
    public function create($id)
    {
        $paciente = Paciente::find($id);
        $paises = Paises::all();

        return view('pacientes.endereco.create', compact('paciente', 'paises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\PacienteEnderecoRequest $request)
    {
        try {
            $data = $request->all();

            // Crie o registro de endereço do paciente
            $recovery = PacienteEndereco::create($data);

            $this->logRegister('Pacientes', 'store', $recovery);
            return redirect()->route('Pacientes.index');
        } catch (Exception $e) {
            // Se ocorrer uma exceção ao criar o registro de endereço
            // Você pode lidar com a exceção aqui, como registrar, exibir uma mensagem de erro, etc.
            \Log::error('Erro ao registrar Endereço do Paciente: ' . $e->getMessage());
            return redirect()->route('Pacientes.index')->with('error', 'Erro ao registrar Endereço do Paciente, contate o suporte!');
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
        $paciente = Paciente::with('enderecoP.pais', 'enderecoP.estado', 'enderecoP.cidade')->find($id);
        $paises = Paises::all();
        return view('pacientes.endereco.edit', compact('paciente', 'paises'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\PacienteEnderecoRequest $request, $id)
    {
        try {
            $data = $request->all();
    
            // Encontre o paciente pelo ID
            $paciente = PacienteEndereco::findOrFail($id);
    
            // Atualize os dados do paciente
            $paciente->fill($data);
            $paciente->save();
            
            $this->logRegister('Pacientes', 'update', $paciente);
            return redirect()->route('Pacientes.index');
        } catch (ModelNotFoundException $e) {
            // Se o paciente não for encontrado
            return redirect()->route('Pacientes.index')->with('error', 'Paciente não encontrado.');
        } catch (\Exception $e) {
            // Se ocorrer uma exceção desconhecida
            \Log::error('Erro ao alterar dados do Endereço do Paciente: ' . $e->getMessage());
            return redirect()->route('Pacientes.index')->with('error',  'Ocorreu um erro ao atualizar o endereço do paciente, contate o suporte!');
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
        try {
            // Exclua o registro de endereço existente
            $pacientes = PacienteEndereco::where('paciente_id', $id)->delete();
            
            $this->logRegister('Pacientes', 'destroy', $pacientes);
            return redirect()->route('Pacientes.index');
        } catch (Exception $e) {
            // Se ocorrer uma exceção ao criar o registro de endereço
            // Você pode lidar com a exceção aqui, como registrar, exibir uma mensagem de erro, etc.
            \Log::error('Erro ao excluir Endereço do Paciente: ' . $e->getMessage());
            return redirect()->route('Pacientes.index')->with('error', 'Erro ao excluir Endereço do Paciente, contate o suporte!');
        }
    }

    public function verificaEnderecoPaciente($id)
    {
        // No seu código onde você precisa verificar se um paciente tem um endereço
        $paciente = Paciente::find($id); // Obtenha o paciente pelo ID
        if ($paciente->enderecoP) {
            //Se caso exista, será redirecionado para editar...
            return redirect()->route('PacientesEndereco.edit', ['id' => $paciente->id_paciente]);
        } else {
            //Se caso não exista, será redirecionado para registrar...
            return redirect()->route('PacientesEndereco.create', ['id' => $paciente->id_paciente]);
        }
    }

    public function getPaises()
    {
        $paises = Paises::all();
        return response()->json($paises);
    }

    public function getEstados($pais_id)
    {
        $states = Estados::where('pais_id', $pais_id)->get();
        return response()->json($states);
    }

    public function getCidades($state_id)
    {
        $cities = Cidades::where('estado_id', $state_id)->get();
        return response()->json($cities);
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
