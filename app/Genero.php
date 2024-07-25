<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $fillable = [
        'nome_genero',
        'abreviatura',
        'registro_sistemico'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_genero';

    protected $table = 'pacientes_genero';
}
