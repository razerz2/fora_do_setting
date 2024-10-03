<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    protected $fillable = [
        'nome',
        'sigla2',
        'sigla3',
        'codigo'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_pais';

    protected $table = 'paises';

    /**
     * Relação com os endereços dos pacientes.
     */
    public function enderecosPacientes()
    {
        return $this->hasMany(PacienteEndereco::class);
    }

    public function estados()
    {
        return $this->hasMany(Estados::class, 'pais_id', 'id_pais');
    }
}
