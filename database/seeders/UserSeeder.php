<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Datos para iniciar sesión en el sistema la primera vez
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@unir.com',
            'password' => Hash::make('password'),
            'active' => 1,
            'creator_user_id' => 1,
            'updater_user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
