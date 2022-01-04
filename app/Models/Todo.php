<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tarea',
        'active',
        'user_id',
    ];

    protected $with = ['creatorUser'];

    public function creatorUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
