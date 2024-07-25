<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GastosProfissionais extends Model
{
    protected $fillable = [
        'despesa',
        'observacao',
        'data_vencimento',
        'data_pagamento',
        'valor_despesa',
        'recursivo',
        'dia_vencimento'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_gpr';

    protected $table = 'gastos_profissional';
}
