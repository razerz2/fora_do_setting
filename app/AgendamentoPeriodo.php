<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendamentoPeriodo extends Model
{
    protected $fillable = [
        'periodo',
        'hora_inicial',
        'hora_final',
        'registro_sistemico'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_ap';

    protected $table = 'agendamento_periodo';

    /**
     * Relação com agendamento.
     */
    public function agendamento()
    {
        return $this->hasOne(Agendamento::class, 'ap_id', 'id_ap');
    }

}
