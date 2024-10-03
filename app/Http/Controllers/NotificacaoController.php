<?php

namespace App\Http\Controllers;

use App\Notificacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtém o ID do usuário autenticado
        $userId = Auth::id();
        // Carrega as notificações apenas para o usuário logado
        $notificacoes = Notificacao::where('user_id', $userId) // Filtra pelo ID do usuário logado
            ->orderBy('data_registro', 'desc') // Ordena por data_registro
            ->get();
        
        return view('notificacao.index', compact('notificacoes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notificacao = Notificacao::with('user')->find($id);

        // Atualiza o campo 'verificado' para true, se ainda não estiver
        if (!$notificacao->verificado) {
            $notificacao->verificado = true;
            $notificacao->save();
        }
        
        return view('Notificacao.show', compact('notificacao'));
    }
}
