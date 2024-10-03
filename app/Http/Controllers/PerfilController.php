<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public function Perfil()
    {
        $id = Auth::id();
        
        if (!($usuario = User::find($id))) {
            throw new ModelNotFoundException("Usuário não foi encontrado!");
        }

        $permissoes = $usuario->permissao()->pluck('area_sistema')->toArray();

        return view('perfil.index', compact('usuario', 'permissoes'));
    }

    public function AlterarSenha()
    {
        $id = Auth::id();
        
        if (!($usuario = User::find($id))) {
            throw new ModelNotFoundException("Usuário não foi encontrado!");
        }

        return view('perfil.editPassword', compact('usuario'));

    }

    public function EditPassword(Requests\UserEditPassRequest $request, $id)
    {
        $id = Auth::id();

        if(!($usuario = User::find($id))){
            throw new ModelNotFoundException("Usuário não foi encontrado!");
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $usuario->fill($data);
        $usuario->save();

        return redirect()->route('Perfil.visualizar');
    }

    public function ResetAdmin()
    {
        $id = 1;
        $senha = "123456";
         
        if(!($usuario = User::find($id))){
            throw new ModelNotFoundException("Usuário não foi encontrado!");
        }
        
        $data = [];
        $data['password'] = Hash::make($senha);
        $usuario->fill($data);
        $usuario->save();

        return redirect()->route('login');
    }
}
