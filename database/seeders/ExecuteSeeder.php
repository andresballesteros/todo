<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExecuteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->call([
            UserSeeder::class,
            RolSeeder::class,
            ModelHasRoleSeeder::class,
            PermissionSeeder::class,
            RoleHasPermissionSeeder::class
        ]);
    }
}
