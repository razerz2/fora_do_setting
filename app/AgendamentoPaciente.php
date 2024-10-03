<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendamentoPaciente extends Model
{
    protected $fillable = [
        'agendamento_id',
        'paciente_id',
        'presencial'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_apc';

    protected $table = 'agendamento_paciente';

    /**
     * Relação com o agendamento.
     */
    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class, 'agendamento_id', 'id_agendamento');
    }

    /**
     * Relação com o paciente.
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id_paciente');
    }
}
