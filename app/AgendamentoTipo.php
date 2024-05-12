<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendamentoTipo extends Model
{
    protected $fillable = [
        'tipo_agendamento',
        'descricao',
        'registro_sistemico'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_at';

    protected $table = 'agendamento_tipo';

    /**
     * Relação com agendamento.
     */
    public function agendamento()
    {
        return $this->hasOne(Agendamento::class, 'at_id', 'id_at');
    }
}
