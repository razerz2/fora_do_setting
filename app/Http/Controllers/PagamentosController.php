<?php

namespace App\Http\Controllers;

use App\Permissoes;
use App\Pagamentos;
use App\PagamentosSessoes;
use App\Paciente;
use App\SessaoPaciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagamentosController extends Controller
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
            if (!Permissoes::verificarPermissao(auth()->user(), 'pagamentos')) {
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
        try {
            // Obtém os pagamentos juntamente com o nome do paciente
            $pagamentos = Pagamentos::join('pacientes', 'pagamentos.paciente_id', '=', 'pacientes.id_paciente')
            ->select('pagamentos.*', 'pacientes.nome_paciente')
            ->get();

            // Retorna a view com os pagamentos
            return view('pagamentos.index', compact('pagamentos'));
        } catch (\Exception $e) {
            // Loga o erro
            Log::error('Erro ao carregar a lista de pagamentos: ' . $e->getMessage());

            // Redireciona com uma mensagem de erro
            return redirect()->route('home')->with('error', 'Erro ao carregar a lista de pagamentos.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            // Obtém os pacientes que têm registros na tabela sessao_paciente
            $pacientes = Paciente::join('sessao_paciente', 'pacientes.id_paciente', '=', 'sessao_paciente.paciente_id')
            ->orderBy('nome_paciente', 'asc')
            ->get(['pacientes.*']);

            // Lista os anos
            $anos = $this->listarAnos();

            // Retorna a view com os pacientes e anos
            return view('pagamentos.create', compact('pacientes', 'anos'));
        } catch (\Exception $e) {
            // Loga o erro
            Log::error('Erro ao carregar a página de criação de pagamentos: ' . $e->getMessage());

            // Redireciona com uma mensagem de erro
            return redirect()->route('Pagamentos.index')->with('error', 'Erro ao carregar a página de criação de pagamentos.');
        }
    }

    /**
     * Show the form for register a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            // Captura todos os dados da requisição
            $data = $request->all();

            // Preenche os dados adicionais
            $data['dia_vencimento'] = $this->buscaDiaVencimento($data['paciente_id']);
            $data['mes_nome'] = $this->retornaNomeMes($data['mes']);
            $data['paciente_nome'] = $this->nomePaciente($data['paciente_id']);
            $data['total_valor'] = $this->valorTotalSessoes($data);

            // Lista as sessões do paciente
            $sessoes = $this->listarSessoesPaciente($data);

            // Verifica se existem sessões
            if ($sessoes->isEmpty()) {
                return redirect()->route('Pagamentos.create')->with('error', 'Nenhum registro de sessão encontrado para este paciente na data informada!');
            }

            // Retorna a view com os dados e as sessões
            return view('pagamentos.register', compact('data', 'sessoes'));
        } catch (\Exception $e) {
            // Loga o erro
            Log::error('Erro ao registrar pagamento: ' . $e->getMessage());

            // Redireciona com uma mensagem de erro
            return redirect()->route('Pagamentos.create')->with('error', 'Erro ao processar o registro de pagamento.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Inicia uma transação para garantir a integridade dos dados
            DB::beginTransaction();

            // Captura todos os dados da requisição
            $data = $request->all();
            $data['data_registro'] = now();

            // Cria o pagamento
            $recovery = Pagamentos::create($data);

            // Lista as sessões do paciente
            $sessoes = $this->listarSessoesPaciente($data);

            // Armazena as sessões do pagamento
            $this->storePagamentoSessoes($recovery->id_pagamento, $sessoes);

            // Confirma a transação
            DB::commit();

            return redirect()->route('Pagamentos.index');
        } catch (\Exception $e) {
            // Reverte a transação em caso de erro
            DB::rollBack();

            // Loga o erro
            Log::error('Erro ao criar pagamento e armazenar sessões: ' . $e->getMessage());

            // Opcional: Retornar uma resposta ou lançar a exceção novamente
            // throw $e;
            return redirect()->route('Pagamentos.index')->with('error', 'Erro ao processar o pagamento.');
        }
    }

    public function storePagamentoSessoes($id_pagamento, $sessoes)
    {
        try {
            // Inicia uma transação para garantir a integridade dos dados
            DB::beginTransaction();

            // Salvar as sessões do pagamento referente
            foreach ($sessoes as $sessao) {
                PagamentosSessoes::create([
                    'pagamento_id' => $id_pagamento,
                    'sessao_id' => $sessao->id_sessao,
                    'valor' => $sessao->valor_sessao
                ]);
            }

            // Confirma a transação
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Reverte a transação em caso de erro
            DB::rollBack();

            // Opcional: Logar o erro ou tratá-lo de alguma forma
            Log::error('Erro ao salvar sessões do pagamento: ' . $e->getMessage());

            // Opcional: Retornar uma resposta ou lançar a exceção novamente
            // throw $e;
            return false;
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
        try {
            // Executa a junção para obter o pagamento e o nome do paciente
            $pagamento = Pagamentos::join('pacientes', 'pagamentos.paciente_id', '=', 'pacientes.id_paciente')
            ->where('id_pagamento', $id)
                ->select('pagamentos.*', 'pacientes.nome_paciente')
                ->first();

            // Lista as sessões do pagamento
            $sessoes = $this->listarPagamentoSessoes($id);

            // Retorna a view com os dados do pagamento e as sessões
            return view('pagamentos.show', compact('pagamento', 'sessoes'));
        } catch (\Exception $e) {
            // Loga o erro
            Log::error('Erro ao obter pagamento e sessões: ' . $e->getMessage());

            // Opcional: Redireciona para uma rota com uma mensagem de erro
            return redirect()->route('Pagamentos.index')->with('error', 'Erro ao carregar os detalhes do pagamento.');
        }
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

    public function excluir(Request $request)
    {
        $id = $request->id_pagamento;

        DB::beginTransaction();
        try {
            // Remover as sessões de pagamentos
            PagamentosSessoes::where('pagamento_id', $id)->delete();

            // Remover pagamento
            Pagamentos::where('id_pagamento', $id)->delete();

            DB::commit();

            return redirect()->route('Pagamentos.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // Loga o erro
            Log::error('Erro ao excluir pagamento: ' . $e->getMessage());

            // Redireciona com uma mensagem de erro
            return redirect()->route('Pagamentos.index')->with('error', 'Erro ao excluir pagamento.');
        }
    }

    public function buscaDiaVencimento($id_paciente)
    {
        $sessao = SessaoPaciente::where('paciente_id', $id_paciente)->first();

        return $sessao->dia_vencimento;
    }

    public function listarAnos()
    {
        $anos = DB::table('sessao')
            ->select(DB::raw('EXTRACT(YEAR FROM data_sessao) as ano'))
            ->distinct()
            ->orderBy('ano', 'asc')
            ->pluck('ano');

        return $anos;
    }

    public function listarSessoesPaciente($data)
    {
        $pacienteId = $data['paciente_id']; // Substitua pelo ID do paciente que você está procurando

        if (array_key_exists('mes', $data)) {
            $mes = $data['mes']; // Substitua pelo mês que você está procurando (1-12)
        } else {
            $mes = $data['n_mes_referente'];
        }

        if (array_key_exists('ano', $data)) {
            $ano = $data['ano'];    // Substitua pelo ano que você está procurando
        } else {
            $ano = $data['ano_referente'];
        }

        $sessoes = DB::table('sessao')
            ->where('paciente_id', $pacienteId)
            ->where(DB::raw('EXTRACT(MONTH FROM data_sessao)'), $mes)
            ->where(DB::raw('EXTRACT(YEAR FROM data_sessao)'), $ano)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('pagamentos_sessoes')
                    ->whereColumn('pagamentos_sessoes.sessao_id', 'sessao.id_sessao');
            })
            ->orderBy('data_sessao', 'asc')
            ->get();

        return $sessoes;
    }

    public function listarPagamentoSessoes($id_pagamento)
    {
        $sessoes = PagamentosSessoes::join('sessao', 'pagamentos_sessoes.sessao_id', '=', 'sessao.id_sessao')
            ->where('pagamento_id', $id_pagamento)
            ->select('pagamentos_sessoes.*', 'sessao.data_sessao')
            ->get();

        return $sessoes;
    }

    public function valorTotalSessoes($data)
    {
        $pacienteId = $data['paciente_id']; // Substitua pelo ID do paciente que você está procurando
        $mes = $data['mes'];       // Substitua pelo mês que você está procurando (1-12)
        $ano = $data['ano'];    // Substitua pelo ano que você está procurando


        $totalValorSessoes = DB::table('sessao')
            ->where('paciente_id', $pacienteId)
            ->where(DB::raw('EXTRACT(MONTH FROM data_sessao)'), $mes)
            ->where(DB::raw('EXTRACT(YEAR FROM data_sessao)'), $ano)
            ->sum('valor_sessao');

        return $totalValorSessoes;
    }

    public function retornaNomeMes($n_mes)
    {
        switch ($n_mes) {
            case 1:
                return "Janeiro";
            case 2:
                return "Fevereiro";
            case 3:
                return "Março";
            case 4:
                return "Abril";
            case 5:
                return "Maio";
            case 6:
                return "Junho";
            case 7:
                return "Julho";
            case 8:
                return "Agosto";
            case 9:
                return "Setembro";
            case 10:
                return "Outubro";
            case 11:
                return "Novembro";
            case 12:
                return "Dezembro";
            default:
                return "";
        }
    }

    public function nomePaciente($id)
    {
        $paciente = Paciente::find($id);

        return $paciente->nome_paciente;
    }
}
