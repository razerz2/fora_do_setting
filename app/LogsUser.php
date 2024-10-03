<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogsUser extends Model
{
    protected $fillable = [
        'user_id',
        'route',
        'action',
        'content',
        'data_registro'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_logs';

    protected $table = 'logs_users';

    /**
     * Relação com o paciente.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
