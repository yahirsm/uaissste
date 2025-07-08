<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // 1) Limpia la cache de permisos de Spatie
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2) Lista de permisos
        $permisos = [
            // Inventario
            'inventario.ver',
            'inventario.crear',
            'inventario.editar',
            'inventario.eliminar',

            // Pedidos (“Distribución – Pedidos”)
            'pedidos.ver',

            // Solicitudes (“Distribución – Solicitudes”)
            'solicitudes.ver',
            'solicitudes.crear',
            'solicitudes.aprobar', // ← permiso para autorizar

            // Reportes
            'reportes.ver',
            'reportes.generar',

            // Usuarios
            'usuarios.ver',
            'usuarios.crear',
            'usuarios.editar',
            'usuarios.eliminar',

            // Perfil (sólo edición)
            'perfil.editar',
        ];

        // 3) Crear cada permiso si no existe
        foreach ($permisos as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 4) Crear roles
        $admin        = Role::firstOrCreate(['name' => 'Administrador']);
        $jefe         = Role::firstOrCreate(['name' => 'Jefe Abasto']);
        $solicitante  = Role::firstOrCreate(['name' => 'Solicitante']);

        // 5) Asignar permisos a cada rol

        // Administrador → todos los permisos
        $admin->syncPermissions($permisos);

        // Jefe Abasto → inventario, reportes, ver pedidos y autorizar solicitudes
        $jefe->syncPermissions([
            'inventario.ver',
            'inventario.crear',
            'inventario.editar',
            'inventario.eliminar',
            'reportes.ver',
            'reportes.generar',
            'pedidos.ver',
            'solicitudes.aprobar',
        ]);

        // Solicitante → sólo ver inventario, crear/ver solicitudes y ver pedidos
        $solicitante->syncPermissions([
            'inventario.ver',
            'solicitudes.ver',
            'solicitudes.crear',
            'pedidos.ver',
        ]);
    }
}
