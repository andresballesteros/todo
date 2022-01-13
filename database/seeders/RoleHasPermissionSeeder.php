<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Se genera ciclo para agregar los ids generados previamente, asignados al role de administrador
        for($i = 1; $i<8; $i++){       
            DB::table('role_has_permissions')->insert([
                'permission_id' => $i,
                'role_id' => 2
            ]);
        }
    }
}
