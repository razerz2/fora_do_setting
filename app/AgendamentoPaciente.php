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
     * Relação com o paciente.
     */
    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }
}
