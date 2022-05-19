<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//Spatie
use Spatie\Permission\Models\Permission;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permisos
        $permisos = [
            'Ver_usuarios',
            'Crear_usuarios',
            'Editar_usuarios',
            'Eliminar_usuarios',
            'Ver_roles',
            'Crear_roles',
            'Editar_roles',
            'Eliminar_roles',
            'Ver_FacturasClientes',
            'Crear_FacturasClientes',
            'Editar_FacturasClientes',
            'Eliminar_FacturasClientes',
            'Ver_FacturasGeneradas',
            'Crear_FacturasGeneradas',
            'Editar_FacturasGeneradas',
            'Eliminar_FacturasGeneradas',
            'Ver_FacturasMasivas',
            'Crear_FacturasMasiva',
            'Editar_FacturasMasiva',
            'Eliminar_FacturasMasiva',
            'Ver_FacturasPendientes',
            'Crear_FacturasPendientes',
            'Editar_FacturasPendientes',
            'Eliminar_FacturasPendientes',
            'Ver_FacturasSolicitadas',
            'Crear_FacturasSolicitadas',
            'Editar_FacturasSolicitadas',
            'Eliminar_FacturasSolicitadas',          
            'Ver_Sistema',
            'Ver_Log',
            
        ];

        foreach($permisos as $permiso){
            Permission::create(['name' => $permiso]);
        }
    }
}
