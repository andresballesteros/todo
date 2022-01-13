<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservacionTodo extends Model
{
    use HasFactory;
    /* Tabla a la que hace referencia el modelo */
    protected $table = 'observaciones_todo';
    /* Atributos para asignación masiva */
    protected $fillable = [
        'todo_id',
        'observacion',
        'user_id',
    ];

    /* Relación de la observación con el usuario */
    public function creatorUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
