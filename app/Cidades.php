<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidades extends Model
{
    protected $fillable = [
        'estado_id',
        'uf',
        'nome_cidade'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_cidade';

    protected $table = 'cidades';

    /**
     * Relação com os endereços dos pacientes.
     */
    public function enderecosPacientes()
    {
        return $this->hasMany(PacienteEndereco::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estados::class, 'estado_id', 'id_estado'); // 'estado_id' é a chave estrangeira em 'cidades'
    }
}
