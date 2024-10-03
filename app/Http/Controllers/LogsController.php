<?php

namespace App\Http\Controllers;

use App\LogsUser;
use App\Permissoes;
use Illuminate\Http\Request;

class LogsController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ordenando por data_registro em ordem decrescente (mais recente primeiro)
        $logs = LogsUser::with('user') // Carrega a relação com o usuário
                     ->orderBy('data_registro', 'desc') // Ordena por data_registro
                     ->get();
        
        return view('log_view.index', compact('logs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $log = LogsUser::with('user')->find($id);
        
        return view('log_view.show', compact('log'));
    }
}
