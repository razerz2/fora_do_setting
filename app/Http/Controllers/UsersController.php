<?php

namespace App\Http\Controllers;

use App\User;
use App\Permissoes;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
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
        $usuarios = User::all();
        
        return view('users.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRequest $request)
    {
        $data = $request->all();
        $image = $request->file('InputFile');
        $permissoes = $data['permissoes'];
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 'ativo';
        $recovery = User::create($data);

        $this->salvaImagemPerfil($image, $recovery->id);
        $this->registraPermissoes($permissoes, $recovery->id);

        return redirect()->route('Users.index');
        
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
        if (!($usuario = User::find($id))) {
            throw new ModelNotFoundException("Usuário não foi encontrado!");
        }

        $permissoes = $usuario->permissao()->pluck('area_sistema')->toArray();

        return view('users.edit', compact('usuario', 'permissoes'));
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
        if(!($usuario = User::find($id))){
            throw new ModelNotFoundException("Usuário não foi encontrado!");
        }
        $data = $request->all();
        $permissoes = $data['permissoes'];
        $image = $request->file('InputFile');
        $usuario->fill($data);
        $usuario->save();

        $this->alterarImagemPerfil($image, $id);
        $this->deletePermissoes($id);
        $this->registraPermissoes($permissoes, $id);

        return redirect()->route('Users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Usuários não podem ser excluídos...
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {

        if(!($usuario = User::find($id))){
            throw new ModelNotFoundException("Usuário não foi encontrado!");
        }

        return view('users.editPassword', compact('usuario'));
    }

    /**
     * Update password the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Requests\UserEditPassRequest $request, $id)
    {
        if(!($usuario = User::find($id))){
            throw new ModelNotFoundException("Usuário não foi encontrado!");
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $usuario->fill($data);
        $usuario->save();

        return redirect()->route('Users.index');
    }

    public function desativar(Request $request)
    {
        $id = $request->id_usuario;
        
        if(!($usuario = User::find($id))){
            throw new ModelNotFoundException("Usuário não foi encontrado!");
        }
        $data = $request->all();
        $data['status'] = 'inativo';
        $usuario->fill($data);
        $usuario->save();

        return redirect()->route('Users.index');
    }

    public function ativar(Request $request)
    {
        $id = $request->id_usuario;
        
        if(!($usuario = User::find($id))){
            throw new ModelNotFoundException("Usuário não foi encontrado!");
        }
        $data = $request->all();
        $data['status'] = 'ativo';
        $usuario->fill($data);
        $usuario->save();

        return redirect()->route('Users.index');
    }

    public function salvaImagemPerfil($image, $id_user)
    {
         // Verifica se existe um arquivo de imagem no pedido
        if ($image) {

            if ($image->isValid() && $image->getClientOriginalExtension()) {
                $customName = 'ft'.$id_user.'.'. $image->getClientOriginalExtension();
                $path = $image->storeAs('images', $customName, 'public');
            }
            
        } else {
            // Se nenhum arquivo de imagem for carregado, copie a imagem padrão
            $defaultImagePath = public_path('img/user-default.jpg'); // Caminho para a imagem padrão
            $customName = 'ft'. $id_user . '.jpg'; // Nome para a imagem padrão

            // Copie a imagem padrão para o sistema de armazenamento
            Storage::disk('public')->put('images/' . $customName, file_get_contents($defaultImagePath));

    
            // Você pode salvar o caminho da imagem padrão no banco de dados se necessário
        }
    }

    public function alterarImagemPerfil($image, $id_user){

        if ($image) {

            if ($image->isValid() && $image->getClientOriginalExtension()) {

                $customName = 'ft'.$id_user.'.'.$image->getClientOriginalExtension();
                $path = 'images/'.$customName;
                Storage::disk('public')->delete($path);
                $path = $image->storeAs('images', $customName, 'public');

            }
            
        }
    }

    public function registraPermissoes($permissoes, $id) {
        try {
            // Salve as permissões do usuário
            $data = [];
            foreach ($permissoes as $permissao) {
                // Aqui você pode criar uma nova entrada na tabela de permissões associada ao usuário
                $data[] = [
                    'user_id' => $id,
                    'area_sistema' => $permissao,
                    'permissao' => true
                    ];
    
            }

            DB::table('permissoes_users')->insert($data);
            
            // Retorne true ou faça qualquer outra coisa que você precise fazer
            return true;
    
        } catch (\Exception $e) {
            // Em caso de erro, trate a exceção aqui
            // Por exemplo, você pode registrar o erro, lançar uma nova exceção ou retornar false
            \Log::error('Erro ao registrar permissões: ' . $e->getMessage());
            return false;
        }
    }

    public function deletePermissoes($userId)
    {
        $user = User::findOrFail($userId);
        
        $user->permissao()->delete(); // Remove todas as permissões associadas ao usuário
        
        return true;
    }
}
