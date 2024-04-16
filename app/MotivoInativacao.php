<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoInativacao extends Model
{
    protected $fillable = [
        'nome_mi',
        'descricao_mi'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_mi';

    protected $table = 'motivo_inativacao';
}
