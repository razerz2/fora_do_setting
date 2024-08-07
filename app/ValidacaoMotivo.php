<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValidacaoMotivo extends Model
{
    protected $fillable = [
        'nome_motivo',
        'descricao_motivo',
        'registro_sistemico'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_vm';

    protected $table = 'validacao_motivo';
}
