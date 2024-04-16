<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status === 'inativo') {
            Auth::logout(); // Faz logout do usuário inativo.
            return redirect('/login')->with('error', 'Usuário Desativado! Por favor, contate o administrador do sistema.');
        }

        return $next($request);
    }
}