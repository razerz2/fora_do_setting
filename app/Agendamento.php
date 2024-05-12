<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [
        'ap_id',
        'at_id',
        'dia',
        'n_dia',
        'horario_inicial',
        'horario_final',
        'data_registro'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_agendamento';

    protected $table = 'agendamento';

    public function agendamentoPeriodo()
    {
        return $this->belongsTo(AgendamentoPeriodo::class, 'ap_id', 'id_ap');
    }

    public function agendamentoTipo()
    {
        return $this->belongsTo(AgendamentoTipo::class, 'at_id', 'id_at');
    }

    /**
     * Relação com endereço do paciente.
     */
    public function agendamentoPaciente()
    {
        return $this->hasOne(AgendamentoPaciente::class, 'agendamento_id');
    }

    /**
     * Relação com endereço do paciente.
     */
    public function agendamenReservado()
    {
        return $this->hasOne(AgendamentoReservado::class, 'agendamento_id');
    }
    
}
