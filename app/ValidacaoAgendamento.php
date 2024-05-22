<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidacaoAgendamento extends Model
{
    protected $fillable = [
        'agendamento_id',
        'data_registro'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_va';

    protected $table = 'validacao_agendamento';
}
