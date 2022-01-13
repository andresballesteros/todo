<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //super-admin
        DB::table('roles')->insert([
            'name' => 'super-admin',
            'display_name' => 'Super Administrador',
            'description' => 'Rol administracion del sistema',
            'guard_name' => 'web',
            'creator_user_id' => 1,
            'updater_user_id' => 1
        ]);
        
        //admin
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Rol administrador',
            'guard_name' => 'web',
            'creator_user_id' => 1,
            'updater_user_id' => 1
        ]);
    }
}
