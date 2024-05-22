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
        'data_sessao'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_sessao';

    protected $table = 'sessao';
}
