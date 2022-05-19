<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
  
        $rol = Role::create([
            'name' => 'Administrador'
        ]);

        $usuario = User::create([
            'id_role' => 1,
            'name' => 'Administrador',
            'email' => 'admin@admin.com',            
            'active' => 1,
            'password' => bcrypt('123456')
        ]);

        $permisos = Permission::pluck('id','id')->all();

        $rol->syncPermissions($permisos);

        $usuario->assignRole([$rol->id]);

    }
}
