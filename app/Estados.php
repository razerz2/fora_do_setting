<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    protected $fillable = [
        'uf',
        'nome_estado'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_estado';

    protected $table = 'estados';

    /**
     * Relação com os endereços dos pacientes.
     */
    public function enderecosPacientes()
    {
        return $this->hasMany(PacienteEndereco::class);
    }
}
