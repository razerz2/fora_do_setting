<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GastosPessoais extends Model
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

    protected $primaryKey = 'id_gpe';

    protected $table = 'gastos_pessoais';
}
