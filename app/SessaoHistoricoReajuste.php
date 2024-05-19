<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessaoHistoricoReajuste extends Model
{
    protected $fillable = [
        'sp_id',
        'paciente_id',
        'dia_vencimento',
        'valor',
        'data_reajuste'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_shr';

    protected $table = 'sessao_historico_reajuste';
}
