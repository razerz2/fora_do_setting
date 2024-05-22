<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessaoCancelada extends Model
{
    protected $fillable = [
        'agendamento_id',
        'sp_id',
        'vm_id',
        'paciente_id',
        'valor',
        'data_registro'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_sc';

    protected $table = 'sessao_cancelada';
}
