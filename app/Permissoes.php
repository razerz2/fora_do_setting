<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissoes extends Model
{
    protected $fillable = [
        'user_id',
        'area_sistema',
        'permissao'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_permissao';

    protected $table = 'permissoes_users';

    public static function verificarPermissao($usuario, $areaSistema)
    {
        // Verifica se o usuário possui permissão para acessar a área do sistema
        return self::where('user_id', $usuario->id)
                    ->where('area_sistema', $areaSistema)
                    ->where('permissao', true)
                    ->exists();
    }
}
