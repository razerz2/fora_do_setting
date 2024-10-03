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
        'genero_id',
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

    // Relacionamento com AgendamentoPaciente (um para muitos)
    public function agendamentoPacientes()
    {
        return $this->hasMany(AgendamentoPaciente::class, 'paciente_id');
    }

    // Relacionamento com Inativacao (um para um)
    public function inativacao()
    {
        return $this->hasOne(Inativacao::class, 'paciente_id', 'id_paciente');
    }
}
