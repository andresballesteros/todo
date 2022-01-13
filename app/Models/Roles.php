<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use  Spatie\Permission\Models\Role;

class Roles extends  Role
{
    use HasFactory;

    /* Relación de la rol con el usuario creador */
    public function creatorUser()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }
    /* Relación de la rol con el usuario actualizador */
    public function updaterUser()
    {
        return $this->belongsTo(User::class, 'updater_user_id');
    }
}
