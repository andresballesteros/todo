<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /* Atributos para asignación masiva */
    protected $fillable = [
        'tarea',
        'active',
        'user_id',
    ];

    /* Relaciones traidas con la consulta del modelo */
    protected $with = ['creatorUser'];

    /* Relación de la tarea con el usuario */
    public function creatorUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
