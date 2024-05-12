<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendamentoReservado extends Model
{
    protected $fillable = [
        'agendamento_id',
        'descricao',
        'presencial'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_ar';

    protected $table = 'agendamento_reservado';

    /**
     * Relação com o paciente.
     */
    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }
}
