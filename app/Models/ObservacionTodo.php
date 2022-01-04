<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservacionTodo extends Model
{
    use HasFactory;
    protected $table = 'observaciones_todo';
    protected $fillable = [
        'todo_id',
        'observacion',
        'user_id',
    ];


    public function creatorUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
