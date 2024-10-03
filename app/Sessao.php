<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    protected $fillable = [
        'agendamento_id',
        'sp_id',
        'paciente_id',
        'valor_sessao',
        'data_sessao',
        'pagamento'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_sessao';

    protected $table = 'sessao';

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id_paciente');
    }
}
