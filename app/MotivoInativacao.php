<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoInativacao extends Model
{
    protected $fillable = [
        'nome_mi',
        'descricao_mi',
        'registro_sistemico'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_mi';

    protected $table = 'motivo_inativacao';

    // Relacionamento com Inativacao (um motivo pode estar em várias inativações)
    public function inativacoes()
    {
        return $this->hasMany(Inativacao::class, 'mi_id', 'id_mi');
    }
}
