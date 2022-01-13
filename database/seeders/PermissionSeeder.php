<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Ver usuarios
        DB::table('permissions')->insert([
            'name' => 'Ver usuarios',
            'guard_name' => 'web',
            'description' => 'Permiso para ver usuarios'
        ]);
        
        //Crear usuarios
        DB::table('permissions')->insert([
            'name' => 'Crear  usuarios',
            'guard_name' => 'web',
            'description' => 'Permiso para crear usuarios'
        ]);
        
        //Actualizar usuarios
        DB::table('permissions')->insert([
            'name' => 'Actualizar  usuarios',
            'guard_name' => 'web',
            'description' => 'Permiso para actualizar usuarios'
        ]);
        
        //Ver roles
        DB::table('permissions')->insert([
            'name' => 'Ver roles',
            'guard_name' => 'web',
            'description' => 'Permiso para ver roles'
        ]);
        
        //Crear roles
        DB::table('permissions')->insert([
            'name' => 'Crear roles',
            'guard_name' => 'web',
            'description' => 'Permiso para crear roles'
        ]);
        
        //Actualizar roles
        DB::table('permissions')->insert([
            'name' => 'Actualizar  roles',
            'guard_name' => 'web',
            'description' => 'Permiso para actualizar roles'
        ]);
        
        //Eliminar roles
        DB::table('permissions')->insert([
            'name' => 'Eliminar roles',
            'guard_name' => 'web',
            'description' => 'Permiso para eliminar roles'
        ]);
    }
}
