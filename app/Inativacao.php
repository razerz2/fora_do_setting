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
}
