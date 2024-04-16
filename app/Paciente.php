<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'nome_paciente',
        'rg',
        'cpf',
        'data_nascimento',
        'idade',
        'sexo',
        'email',
        'telefone_1',
        'resp_tel_1',
        'telefone_2',
        'resp_tel_2',
        'status'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_paciente';

    protected $table = 'pacientes';

    /**
     * Relação com endereço do paciente.
     */
    public function enderecoP()
    {
        return $this->hasOne(PacienteEndereco::class, 'paciente_id');
    }
}
