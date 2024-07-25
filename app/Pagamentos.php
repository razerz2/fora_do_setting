<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
    protected $fillable = [
        'paciente_id',
        'dia_vencimento',
        'valor_pagamento',
        'data_pagamento',
        'mes_referente',
        'n_mes_referente',
        'ano_referente',
        'data_registro'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_pagamento';

    protected $table = 'pagamentos';
}
