<?php

namespace App\Http\Controllers;

use App\Agendamento;
use App\Permissoes;
use App\Paciente;
use App\Sessao;
use App\SessaoPaciente;
use App\SessaoCancelada;
use App\ValidacaoAgendamento;
use App\ValidacaoMotivo;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ValidacaoAgendamentoController extends Controller
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
            if (!Permissoes::verificarPermissao(auth()->user(), 'sessoes')) {
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
        $agendamentos = ValidacaoAgendamento::join('agendamento', 'validacao_agendamento.agendamento_id', '=', 'agendamento.id_agendamento')
        ->join('agendamento_paciente', 'agendamento.id_agendamento', '=', 'agendamento_paciente.agendamento_id')
        ->join('pacientes', 'agendamento_paciente.paciente_id', '=', 'pacientes.id_paciente')
        ->orderBy('validacao_agendamento.data_registro', 'asc')
        ->select('validacao_agendamento.*', 'agendamento.*', 'agendamento_paciente.*', 'pacientes.*')
        ->get();

        $motivos_validacao = ValidacaoMotivo::all();

        return view('validacao.index', compact('agendamentos', 'motivos_validacao'));
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

    public function validar(Request $request)
    {
        $id_va = $request->id_va;

        try {

            // Buscar Validação Agendamento.
            $validacao = ValidacaoAgendamento::find($id_va);

            if (!$validacao) {
                // Buscar informações do paciente para exibir na mensagem de erro
                return redirect()->route('ValidacaoAgendamento.index')->with('error', ' Nenhum registro a ser validado encontrado!');
            }
            // Join entre agendamento e agendamento_paciente
            $agendamento = Agendamento::join('agendamento_paciente', 'agendamento.id_agendamento', '=', 'agendamento_paciente.agendamento_id')
            ->where('agendamento.id_agendamento', $validacao->agendamento_id)
                ->select('agendamento.*', 'agendamento_paciente.*')
                ->firstOrFail(); // Lança uma exceção se não encontrar

            // Buscar a sessão do paciente
            $sessao_paciente = SessaoPaciente::where('paciente_id', $agendamento['paciente_id'])->first();

            if (!$sessao_paciente) {
                // Buscar informações do paciente para exibir na mensagem de erro
                $paciente = Paciente::find($agendamento['paciente_id']);
                return redirect()->route('ValidacaoAgendamento.index')->with('error', 'Paciente: ' . $paciente->nome_paciente . ', não tem valores por sessão registrados.');
            }

            // Preparar os dados para criar uma nova sessão
            $data = [
                'agendamento_id' => $agendamento['id_agendamento'],
                'sp_id' => $sessao_paciente['id_sp'],
                'paciente_id' => $agendamento['paciente_id'],
                'valor_sessao' => (float) $sessao_paciente['valor_sessao'],
                'data_sessao' => $validacao->data_registro
            ];

            // Criar a nova sessão
            $recovery = Sessao::create($data);

            // Remover a validação do agendamento
            ValidacaoAgendamento::where('id_va', $id_va)->delete();

            return redirect()->route('ValidacaoAgendamento.index');

        } catch (ModelNotFoundException $e) {
            // Caso o agendamento não seja encontrado
            \Log::error('Agendamento não encontrado.: ' . $e->getMessage());
            return redirect()->route('ValidacaoAgendamento.index')->with('error', 'Agendamento não encontrado.');
        } catch (\Exception $e) {
            // Tratamento de qualquer outra exceção
            \Log::error('Ocorreu um erro durante a validação: ' . $e->getMessage());
            return redirect()->route('ValidacaoAgendamento.index')->with('error', 'Ocorreu um erro durante a validação: ' . $e->getMessage());
        }
    }


    public function validarSelecionados(Request $request)
    {
        $data = $request->all();

        // Verifica se 'selected' está definido e é um array
        if (isset($data['selected']) && is_array($data['selected'])) {
            // Percorre cada item em 'selected'
            foreach ($data['selected'] as $id_va) {
                try {
                    // Buscar Validação Agendamento.
                    $validacao = ValidacaoAgendamento::find($id_va);

                    if (!$validacao) {
                        // Buscar informações do paciente para exibir na mensagem de erro
                        return redirect()->route('ValidacaoAgendamento.index')->with('error', ' Nenhum registro a ser validado encontrado!');
                    }
                    // Join entre agendamento e agendamento_paciente
                    $agendamento = Agendamento::join('agendamento_paciente', 'agendamento.id_agendamento', '=', 'agendamento_paciente.agendamento_id')
                        ->where('agendamento.id_agendamento', $validacao->agendamento_id)
                        ->select('agendamento.*', 'agendamento_paciente.*')
                        ->firstOrFail(); // Lança uma exceção se não encontrar


                    $sessao_paciente = SessaoPaciente::where('paciente_id', $agendamento['paciente_id'])->first();

                    if (!$sessao_paciente) {
                        $paciente = Paciente::find($agendamento['paciente_id']);
                        return redirect()->route('ValidacaoAgendamento.index')->with('error', 'Paciente: ' . $paciente->nome_paciente . ', não tem valores por sessão registrados.');
                    }

                    // Preparar os dados para criar uma nova sessão
                    $dataSessao = [
                        'agendamento_id' => $agendamento['id_agendamento'],
                        'sp_id' => $sessao_paciente['id_sp'],
                        'paciente_id' => $agendamento['paciente_id'],
                        'valor_sessao' => (float) $sessao_paciente['valor_sessao'],
                        'data_sessao' => $validacao->data_registro
                    ];

                    Sessao::create($dataSessao);
                    ValidacaoAgendamento::where('id_va', $id_va)->delete();

                } catch (ModelNotFoundException $e) {
                    // Caso o agendamento não seja encontrado
                    \Log::error('Agendamento não encontrado.: ' . $e->getMessage());
                    return redirect()->route('ValidacaoAgendamento.index')->with('error', 'Agendamento com ID ' . $id_agendamento . ' não encontrado.');
                } catch (\Exception $e) {
                    // Tratamento de qualquer outra exceção
                    \Log::error('Ocorreu um erro durante a validação: ' . $e->getMessage());
                    return redirect()->route('ValidacaoAgendamento.index')->with('error', 'Ocorreu um erro durante a validação do agendamento com ID ' . $id_agendamento . ': ' . $e->getMessage());
                }
            }

            return redirect()->route('ValidacaoAgendamento.index');
        } else {
            return redirect()->route('ValidacaoAgendamento.index')->with('error', 'Nenhum agendamento selecionado.');
        }
    }


    public function invalidar(Request $request)
    {
        $id_va = $request->id_va;
        $vm_id = $request->vm_id;

        try {
            // Buscar Validação Agendamento.
            $validacao = ValidacaoAgendamento::find($id_va);

            if (!$validacao) {
                // Buscar informações do paciente para exibir na mensagem de erro
                return redirect()->route('ValidacaoAgendamento.index')->with('error', ' Nenhum registro a ser validado encontrado!');
            }
            // Join entre agendamento e agendamento_paciente
            $agendamento = Agendamento::join('agendamento_paciente', 'agendamento.id_agendamento', '=', 'agendamento_paciente.agendamento_id')
            ->where('agendamento.id_agendamento', $validacao->agendamento_id)
                ->select('agendamento.*', 'agendamento_paciente.*')
                ->firstOrFail(); // Lança uma exceção se não encontrar

            // Buscar a sessão do paciente
            $sessao_paciente = SessaoPaciente::where('paciente_id', $agendamento['paciente_id'])->first();

            if (!$sessao_paciente) {
                // Buscar informações do paciente para exibir na mensagem de erro
                $paciente = Paciente::find($agendamento['paciente_id']);
                return redirect()->route('ValidacaoAgendamento.index')->with('error', 'Paciente: ' . $paciente->nome_paciente . ', não tem valores por sessão registrados.');
            }

            // Buscar a sessão do paciente
            $Validacao = ValidacaoAgendamento::where('agendamento_id', $agendamento['paciente_id'])->first();

            // Preparar os dados para criar uma nova sessão
            $data = [
                'agendamento_id' => $agendamento['id_agendamento'],
                'sp_id' => $sessao_paciente['id_sp'],
                'vm_id' => $vm_id,
                'paciente_id' => $agendamento['paciente_id'],
                'valor' => (float) $sessao_paciente['valor_sessao'],
                'data_registro' => $validacao->data_registro
            ];

            //dd($data);

            // Criar a nova sessão
            $recovery = SessaoCancelada::create($data);

            // Remover a validação do agendamento
            ValidacaoAgendamento::where('id_va', $id_va)->delete();

            return redirect()->route('ValidacaoAgendamento.index');

        } catch (ModelNotFoundException $e) {
            // Caso o agendamento não seja encontrado
            \Log::error('Agendamento não encontrado.: ' . $e->getMessage());
            return redirect()->route('ValidacaoAgendamento.index')->with('error', 'Agendamento não encontrado.');
        } catch (\Exception $e) {
            // Tratamento de qualquer outra exceção
            \Log::error('Ocorreu um erro durante a invalidação: ' . $e->getMessage());
            return redirect()->route('ValidacaoAgendamento.index')->with('error', 'Ocorreu um erro durante a invalidação: ' . $e->getMessage());
        }
    }
}
