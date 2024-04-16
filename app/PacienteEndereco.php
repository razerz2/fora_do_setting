<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PacienteEndereco extends Model
{
    protected $fillable = [
        'paciente_id',
        'pais_id',
        'estado_id',
        'cidade_id',
        'endereco',
        'n_endereco',
        'complemento',
        'cep'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_ep';

    protected $table = 'pacientes_endereco';

    /**
     * Relação com o paciente.
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    /**
     * Relação com o estado do endereço.
     */
    public function pais()
    {
        return $this->belongsTo(Paises::class, 'pais_id');
    }

    /**
     * Relação com o estado do endereço.
     */
    public function estado()
    {
        return $this->belongsTo(Estados::class, 'estado_id');
    }

    /**
     * Relação com a cidade do endereço.
     */
    public function cidade()
    {
        return $this->belongsTo(Cidades::class, 'cidade_id');
    }

}
