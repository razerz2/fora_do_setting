<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessaoPaciente extends Model
{
    protected $fillable = [
        'paciente_id',
        'dia_vencimento',
        'valor_sessao',
        'data_registro',
        'recibo'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_sp';

    protected $table = 'sessao_paciente';

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id_paciente');
    }
}
