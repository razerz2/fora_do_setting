<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $fillable = [
        'user_id',
        'route',
        'message',
        'data_registro',
        'verificado'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_notificacao';

    protected $table = 'notificacao';

    /**
     * Relação com o paciente.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Método para listar notificações ordenadas por data
    public static function listarNotificacoes($id)
    {
        return self::where('user_id', $id)
                    ->orderBy('data_registro', 'desc') // Ordena por data_registro em ordem decrescente
                    ->take(3)
                    ->get();
    }

    // Método para contar notificações não verificadas
    public static function NotificacoesNaoVerificadas($id)
    {
        return self::where('user_id', $id)
                    ->where('verificado', false) // Filtra notificações onde verificado é false
                    ->count();
    }
}
