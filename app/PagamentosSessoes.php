<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagamentosSessoes extends Model
{
    protected $fillable = [
        'pagamento_id',
        'sessao_id',
        'valor'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_pg';

    protected $table = 'pagamentos_sessoes';
}
