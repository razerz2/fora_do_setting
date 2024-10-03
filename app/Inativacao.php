<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inativacao extends Model
{
    protected $fillable = [
        'paciente_id',
        'mi_id'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_inativacao';

    protected $table = 'inativacao';

    // Relacionamento com Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id_paciente');
    }

    // Relacionamento com MotivoInativacao
    public function motivoInativacao()
    {
        return $this->belongsTo(MotivoInativacao::class, 'mi_id', 'id_mi');
    }
}
